<?php

namespace App\Http\Controllers;

use App\Exports\FilteredSalesReportExport;
use App\Exports\ProductsByCategoryExport;
use App\Exports\ProductsExport;
use App\Exports\SalesReportExport;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ReportAnalysisController extends Controller
{
    public function index()
    {
        $paymentMethods = Order::select('payment_method')
            ->get()
            ->groupBy('payment_method');
        $orders = Order::latest()->get();
        $subTotal = Order::latest()->sum('grand_total');
        $shippingTotal = Order::latest()->sum('shipping_cost');
        $couponTotal = Order::latest()->sum('coupon_discount');
        $grandTotal = $subTotal+$shippingTotal - $couponTotal;
        return view('admin.report.sales', compact('orders', 'grandTotal', 'paymentMethods'));
    }

    public function salesReportExport(Request $request)
    {
        if ($request->type =='excel')
        {
            return Excel::download(new SalesReportExport(), 'sales-report.xlsx');
        }
        else
        {
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'UTF-8',
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
                'default_font' => 'nikosh',
            ]);
            // Fetch order and calculate the total
            $orders = Order::select('order_code', 'total_qty', 'shipping_cost', 'coupon_discount', 'payment_method', 'grand_total', 'created_at', 'order_status', 'payment_status')
                ->get()
                ->map(function ($order) {
                    return [
                        'order_code' => $order->order_code,
                        'num_of_qty' => $order->total_qty,
                        'order_total' => $order->grand_total + $order->shipping_cost - $order->coupon_discount,
                        'order_date' => $order->created_at->format('d/m/Y'),
                        'order_status' => Str::ucfirst($order->order_status),
                        'payment_method' => $order->payment_method == 'cod' ? 'Cash on delivery' : Str::ucfirst($order->payment_method),
                        'payment_status' => Str::ucfirst($order->payment_status)
                    ];
                });

            // Calculate the total order amount
            $totalOrderAmount = $orders->sum('order_total');

            // Append the total as the last row
            $orders->push([
                'order_code' => 'Total',
                'num_of_qty' => '',
                'order_total' => round($totalOrderAmount),
                'order_date' => '',
                'order_status' => '',
                'payment_method' => '',
                'payment_status' => ''
            ]);

            // Generate the PDF
            $pdf = view('admin.report.sales-report', ['orders' => $orders])->render();
            $mpdf->WriteHTML($pdf);
//        $mpdf->Output();
            $mpdf->Output('sales-report' . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
        }
    }

    public function salesWiseReport(Request $request)
    {
        $order_status = $request->input('order_status');
        $payment_method = $request->input('payment_method');
        $payment_status = $request->input('payment_status');
        $created_at = $request->input('date_range');
        $selectedDate = $request->input('date_range'); // Get the selected date from the form

        $query = Order::query();

        if ($order_status) {
            $query->where('order_status', $order_status);
        }

        if ($payment_method) {
            $query->where('payment_method', $payment_method);
        }

        if ($payment_status) {
            $query->where('payment_status', $payment_status);
        }
        if ($payment_status) {
            $query->where('payment_status', $payment_status);
        }

        if ($created_at) {
            $dates = explode(' - ', $created_at);
            $start_date = Carbon::parse($dates[0]);
            $end_date = Carbon::parse($dates[1]);

            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $orders = $query->get();
        $subTotal = $query->sum('grand_total');
        $shippingTotal = $query->sum('shipping_cost');
        $couponTotal = $query->sum('coupon_discount');
        $grandTotal = $subTotal+$shippingTotal-$couponTotal;
        $paymentMethods = Order::select('payment_method')
            ->get()
            ->groupBy('payment_method');


        return view('admin.report.sales-wise', compact('orders', 'paymentMethods','order_status', 'payment_status', 'grandTotal', 'selectedDate'));
    }

    public function FilteredSalesReportExport(Request $request)
    {
        // Get filters from request
        $order_status = $request->input('order_status');
        $payment_method = $request->input('payment_method');
        $payment_status = $request->input('payment_status');
        $created_at = $request->input('date_range');
        $dates = explode(' - ', $created_at);
        $start_date = $dates[0] ?? null;
        $end_date = $dates[1] ?? null;

        if ($request->type == 'excel')
        {
            return Excel::download(new FilteredSalesReportExport($order_status,$payment_method, $payment_status, $start_date, $end_date), 'filtered-sales-report.xlsx');
        }
        else
        {
            return $this->downloadSalesReportPDF($order_status, $payment_method, $payment_status, $start_date, $end_date);
        }
    }

    public function downloadSalesReportPDF($order_status, $payment_method, $payment_status, $start_date, $end_date)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'UTF-8',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'default_font' => 'nikosh',
        ]);

        // Initialize filters
        $order_status = $order_status !== 'null' ? $order_status : null;
        $payment_method = $payment_method !== 'null' ? $payment_method : null;
        $payment_status = $payment_status !== 'null' ? $payment_status : null;
        $start_date = $start_date !== 'null' ? $start_date : null;
        $end_date = $end_date !== 'null' ? $end_date : null;

        // Build query
        $query = Order::query();

        if ($order_status) {
            $query->where('order_status', $order_status);
        }

        if ($payment_method) {
            $query->where('payment_method', strtolower($payment_method));
        }

        if ($payment_status) {
            $query->where('payment_status', $payment_status);
        }

        if ($start_date && $end_date) {
            $start_date = Carbon::parse($start_date)->startOfDay();
            $end_date = Carbon::parse($end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        // Fetch filtered orders and map them
        $orders = $query->get()->map(function ($order) {
            return [
                'order_code' => $order->order_code,
                'num_of_qty' => $order->total_qty,
                'order_total' => $order->grand_total + $order->shipping_cost - $order->coupon_discount,
                'order_date' => $order->created_at->format('d/m/Y'),
                'order_status' => Str::ucfirst($order->order_status),
                'payment_method' => $order->payment_method === 'cod' ? 'Cash on delivery' : Str::ucfirst($order->payment_method),
                'payment_status' => Str::ucfirst($order->payment_status),
            ];
        });

        // Calculate total order amount
        $totalOrderAmount = $orders->sum('order_total');

        // Append total row
        $orders->push([
            'order_code' => 'Total',
            'num_of_qty' => '',
            'order_total' => round($totalOrderAmount),
            'order_date' => '',
            'order_status' => '',
            'payment_method' => '',
            'payment_status' => '',
        ]);

        // Generate the PDF
        $pdf = view('admin.report.sales-filtered-pdf', [
            'orders' => $orders,
            'filters' => [
                'order_status' => $order_status,
                'payment_method' => $payment_method,
                'payment_status' => $payment_status,
                'start_date' => $start_date ? Carbon::parse($start_date)->format('d/m/Y') : null,
                'end_date' => $end_date ? Carbon::parse($end_date)->format('d/m/Y') : null,
            ]
        ])->render();
        $mpdf->WriteHTML($pdf);
//        $mpdf->Output();
        $mpdf->Output('sales-report' . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
        // Pass data to the view
    }


    public function stock()
    {
        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        $categories_dropdown = "<option selected disabled> Select Category </option>";
        foreach ($categories as $cat)
        {
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->category_name." </option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat)
            {
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;&nbsp;---".$sub_cat->category_name." </option>";
            }
        }

        $products = Product::where('status', 1)->get();
        return view('admin.report.stock', compact('categories', 'categories_dropdown', 'products'));
    }

    public function exportProducts(Request $request)
    {
        if ($request->type == 'excel')
        {
            return Excel::download(new ProductsExport(), 'products-stock.xlsx');
        }
        else
        {
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'UTF-8',
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
                'default_font' => 'nikosh',
            ]);
            // Fetch product data
            $products = Product::select('name', 'num_of_sale', 'stock', 'sell_price')
                ->get()
                ->map(function($product) {
                    return [
                        'name' => $product->name,
                        'num_of_sale' => $product->num_of_sale,
                        'stock' => $product->stock,
                        'sell_price' => $product->sell_price,
                        'total_stock_value' => $product->stock * $product->sell_price
                    ];
                });
            // Generate the PDF
            $pdf = view('admin.report.product-stock', [
                'products' => $products,
            ])->render();
            $mpdf->WriteHTML($pdf);
//        $mpdf->Output();
            $mpdf->Output('products-stock' . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);

        }
    }

    public function categoryWiseStock(Request $request)
    {
        // Validate category_id is required
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        $categories_dropdown = "<option selected disabled>Select Category</option>";
        foreach ($categories as $category)
        {
            if ($category->id == $request->category_id)
            {
                $selected = "selected";
            }
            else
            {
                $selected = "";
            }
            $categories_dropdown .="<option value='".$category->id."' ".$selected.">".$category->category_name."</option>";
            $sub_categories = Category::where(['parent_id' => $category->id])->get();
            foreach ($sub_categories as $sub_category)
            {
                if ($sub_category->id == $request->category_id)
                {
                    $selected = "selected";
                }
                else
                {
                    $selected = "";
                }
                $categories_dropdown .="<option value='".$sub_category->id."' ".$selected.">&nbsp;&nbsp;---".$sub_category->category_name."</option>";
            }
        }

        $category = Category::with('descendants')->find($request->category_id);
        $categoryIds = $category->descendants->pluck('id')->toArray();
        $categoryIds[] = $request->category_id;
        $products = Product::whereIn('category_id', $categoryIds)->where('status', 1)->get();
        return view('admin.report.category-wise', compact('products', 'categories_dropdown', 'category'));
    }


    public function exportProductsCategoryWise(Request $request)
    {
        if ($request->type == 'excel')
        {
            return Excel::download(new ProductsByCategoryExport($request->category_id), 'category-wise-products.xlsx');
        }
        else
        {
            return $this->exportProductsByCategoryAsPDF($request->category_id);
        }
    }

    public function exportProductsByCategoryAsPDF($category_id)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'UTF-8',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'default_font' => 'nikosh',
        ]);
        // Fetch category and its descendants
        $category = Category::with('descendants')->find($category_id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Get all category IDs (including descendants)
        $categoryIds = $category->descendants->pluck('id')->toArray();
        $categoryIds[] = $category_id;

        // Fetch products for the category and its descendants
        $products = Product::whereIn('category_id', $categoryIds)
            ->where('status', 1) // Assuming 'status' is the field for active products
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'num_of_sale' => $product->num_of_sale,
                    'stock' => $product->stock,
                    'sell_price' => $product->sell_price,
                    'total_stock_value' => $product->stock * $product->sell_price,
                ];
            });

        $pdf = view('admin.report.product_category_report', [
            'categoryName' => $category->category_name,
            'products' => $products,
        ])->render();
        $mpdf->WriteHTML($pdf);
//        $mpdf->Output();
        $mpdf->Output('category-wise-products-stock' . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }
}
