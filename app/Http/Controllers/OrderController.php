<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Cart;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;
use Session;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.order.index', compact('orders'));
    }
    public function pending()
    {
        $orders = Order::where('order_status', 'pending')->orderBy('id', 'desc')->get();
        return view('admin.order.pending', compact('orders'));
    }
    public function newOrder()
    {
        $orders = Order::where('order_status', 'pending')->latest()->limit(10)->get();
        return view('admin.order.new-order', compact('orders'));
    }
    public function confirmed()
    {
        $orders = Order::where('order_status', 'confirmed')->orderBy('id', 'desc')->get();
        return view('admin.order.confirmed', compact('orders'));
    }
    public function returned()
    {
        $orders = Order::where('order_status', 'returned')->orderBy('id', 'desc')->get();
        return view('admin.order.returned', compact('orders'));
    }
    public function proccessing()
    {
        $orders = Order::where('order_status', 'proccessing')->orderBy('id', 'desc')->get();
        return view('admin.order.proccessing', compact('orders'));
    }
    public function delivered()
    {
        $orders = Order::where('order_status', 'delivered')->orderBy('id', 'desc')->get();
        return view('admin.order.delivered', compact('orders'));
    }
    public function shipped()
    {
        $orders = Order::where('order_status', 'shipped')->orderBy('id', 'desc')->get();
        return view('admin.order.shipped', compact('orders'));
    }
    public function canceled()
    {
        $orders = Order::where('order_status', 'cancel')->orderBy('id', 'desc')->get();
        return view('admin.order.canceled', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.order.show', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|regex:/^[0-9]{11}$/', // Validates an 11-digit phone number
            'address' => 'required|string|max:255',
            'shipping_cost' => 'required|numeric', // Ensure a valid shipping cost is selected
            'payment_method' => 'required|string', // Ensure it's "cod" for Cash on Delivery
            'agree_policy' => 'required|accepted', // Ensure the user agrees to the terms
        ]);
        $cartProducts = Cart::getContent();

        if (count($cartProducts) < 1)
        {
            flash()->error('error','Cart is empty!');
            return redirect()->route('home');
        }
        $quantity = count($cartProducts);
        $shipping_cost = $request->shipping_cost;
        $order_total = Cart::getTotal();
        if ($request->couponDiscount)
        {
            $couponDiscount = $request->couponDiscount;
        }
        else
        {
            $couponDiscount = 0;
        }
        $couponCode = $request->couponCodeShow;

        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->mobile = $request->mobile;
        $order->order_code = date('ymd-His') . '-' . rand(11111, 99999);
        if (Session::get('customer_id'))
        {
            $order->order_type = 'registered_customer';
            $order->customer_id = Session::get('customer_id');
        }
        else
        {
            $order->order_type = 'guest';
        }
        $order->grand_total = $order_total;
        $order->coupon_discount = $couponDiscount;
        $order->coupon_code = $couponCode;
        $order->total_qty = $quantity;
        $order->address = $request->address;
        $order->shipping_cost = $shipping_cost;
        $order->order_note = $request->order_note;
        $order->city_id = $request->city_id;
        $order->payment_method = $request->payment_method;
        $order->order_status = 'pending';
        $order->payment_status = 'pending';
        $order->delivery_status = 'pending';
        $order->save();
        if ($request->payment_method == 'cod')
        {
            $payment_history = new PaymentHistory();
            $payment_history->order_id = $order->id;
            $payment_history->payment_method = 'cash on delivery';
            $payment_history->payment_status = 'pending';
            $payment_history->amount = $order_total + $shipping_cost - $couponDiscount;
            $payment_history->save();
        }
        else
        {
            $payment_history = new PaymentHistory();
            $payment_history->order_id = $order->id;
            $payment_history->payment_method = $request->payment_method;
            $payment_history->payment_status = 'pending';
            $payment_history->amount = $order_total + $shipping_cost - $couponDiscount;
            $payment_history->save();
        }
        $cartProducts = Cart::getContent();

        foreach ($cartProducts as $cartProduct) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $cartProduct->attributes->product_id;
            $order_detail->price = $cartProduct->price;
            $order_detail->qty = $cartProduct->quantity;
            $order_detail->product_id = $cartProduct->attributes->product_id;
            $order_detail->discount = $cartProduct->attributes->discount;
            $order_detail->discount_type = $cartProduct->attributes->discount_type;
            if ($cartProduct->attributes->variant_id != null)
            {
                $order_detail->variant_id = $cartProduct->attributes->variant_id;
            }
            if ($cartProduct->attributes->color_id != null) {
                $order_detail->color_id = $cartProduct->attributes->color_id;
            }
            if ($cartProduct->attributes->size_id != null) {
                $order_detail->size_id = $cartProduct->attributes->size_id;
            }
            $order_detail->save();

            // Decrease stock in the products table
            $product = Product::find($cartProduct->attributes->product_id);
            if ($product) {
                $product->num_of_sale += $cartProduct->quantity; // Increase the number of sales
                $product->stock -= $cartProduct->quantity; // Decrease total product stock
                $product->save();
            }

            // Decrease stock in the variants table (size-wise)
            $variant = Variant::find($cartProduct->attributes->variant_id);
            if ($variant) {
                $variant->qty -= $cartProduct->quantity; // Decrease variant stock
                $variant->save();
            }

            Cart::remove($cartProduct->id);
        }

        //sent invoice
    //            if ($request->email != null)
    //            {
    //                $this->sendOrderInvoice($order);
    //            }
    //            $this->sendOrderInvoiceToAdmin($order);

        Session::put('order_id', $order->id);
        Session::put('payment_history_id', $payment_history->id);
        if (Session::get('order_id') != null)
        {
            $decorator = __NAMESPACE__ . '\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $request->payment_method))) . "PaymentController";
            if (class_exists($decorator))
            {
                return (new $decorator)->initiatePayment();
            }
            return redirect()->route('order.confirmation')->with('success', 'Your order has been placed! thank you');
        }
    }

    public function checkout_done()
    {
        $order = Order::find(Session::get('order_id'));
        $payment = PaymentHistory::find(Session::get('payment_history_id'));

        $order->payment_status = 'paid';
        $order->save();
        $payment->payment_status = 'paid';
        $payment->save();
        Session::forget('payment_history_id');
        return redirect()->route('order.confirmation')->with('success', 'Your order has been placed! thank you');
    }

    public function checkout_fail()
    {
        $order = Order::find(Session::get('order_id'));
        $payment = PaymentHistory::find(Session::get('payment_history_id'));

        $order->payment_status = 'un_paid';
        $order->save();
        $payment->payment_status = 'un_paid';
        $payment->save();
        Session::forget('payment_history_id');
        return redirect()->route('order.confirmation')->with('success', 'Your order has been placed! thank you');
    }

    public function confirmation()
    {
        $order_id = Session::get('order_id');
        if ($order_id)
        {
            $order = Order::find($order_id);
            return view('front.pages.order-confirmation', compact('order'));
        }
        else
        {
            return redirect()->route('home');
        }

    }

    public function delete($id)
    {
        $order = Order::find($id);
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();
        $paymentHistories = PaymentHistory::where('order_id', $order->id)->get();

        foreach ($orderDetails as $orderDetail)
        {
            $orderDetail->delete();
        }
        foreach ($paymentHistories as $paymentHistory)
        {
            $paymentHistory->delete();
        }
        $order->delete();

        flash()->success('Order Delete', 'Order delete successfully');
        return redirect()->back();
    }

    public function paymentStatusUpdate(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->payment_status = $request->payment_status;
        $order->save();
        $payment_history = PaymentHistory::where('order_id', $request->order_id)->first();
        $payment_history->payment_status = 'paid';
        $payment_history->save();
        return redirect()->back()->with('success', 'Payment status update successfull');
    }
    public function orderStatusUpdate(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->order_status = $request->order_status;
        $order->save();

        if ($request->order_status == 'cancel')
        {
            foreach ($order->orderDetails as $orderDetail)
            {
                // Decrease stock in the products table
                $product = Product::find($orderDetail->product_id);
                if ($product) {
                    $product->num_of_sale -= $orderDetail->qty; // Increase the number of sales
                    $product->stock += $orderDetail->qty; // Decrease total product stock
                    $product->save();
                }

                // Decrease stock in the variants table (size-wise)
                $variant = Variant::find($orderDetail->variant_id);
                if ($variant) {
                    $variant->qty += $orderDetail->qty; // Decrease variant stock
                    $variant->save();
                }
            }
        }
        if ($request->order_status == 'returned')
        {
            foreach ($order->orderDetails as $orderDetail)
            {
                // Decrease stock in the products table
                $product = Product::find($orderDetail->product_id);
                if ($product) {
                    $product->num_of_sale -= $orderDetail->qty; // Increase the number of sales
                    $product->stock += $orderDetail->qty; // Decrease total product stock
                    $product->save();
                }

                // Decrease stock in the variants table (size-wise)
                $variant = Variant::find($orderDetail->variant_id);
                if ($variant) {
                    $variant->qty += $orderDetail->qty; // Decrease variant stock
                    $variant->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Order status update successfull');
    }

    public function invoice($id)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'UTF-8',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'default_font' => 'nikosh',
        ]);
        $order = Order::find($id);
        $setting = GeneralSetting::latest()->first();
        // Convert the image to a base64 string
        $imagePath = asset($setting->header_logo);
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Convert the image to a base64 string
        $paidImagePath = asset('front/assets/images/apaid.png');
        $paidImageData = base64_encode(file_get_contents($paidImagePath));
        $paidImageSrc = 'data:image/png;base64,' . $paidImageData;
        // Convert the image to a base64 string

        $unpaidImagePath = asset('front/assets/images/unpaid.png');
        $unpaidImageData = base64_encode(file_get_contents($unpaidImagePath));
        $unpaidImageSrc = 'data:image/png;base64,' . $unpaidImageData;

        if (!$order) {
            abort(404, 'Order not found');
        }
        $pdf = view('front.invoice.invoice', [
            'order' => $order,
            'imageSrc' => $imageSrc,
            'paidImageSrc' => $paidImageSrc,
            'unpaidImageSrc' => $unpaidImageSrc
        ])->render();
        $code = $order->order_code;
        $mpdf->WriteHTML($pdf);
//        $mpdf->Output();
        $mpdf->Output($code . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }
//    public function invoice($id)
//    {
//
//        $order = Order::find($id);
//        $setting = GeneralSetting::latest()->first();
//        // Convert the image to a base64 string
//        $imagePath = asset($setting->header_logo);
//        $imageData = base64_encode(file_get_contents($imagePath));
//        $imageSrc = 'data:image/png;base64,' . $imageData;
//
//        // Convert the image to a base64 string
//        $paidImagePath = asset('front/assets/images/paid.png');
//        $paidImageData = base64_encode(file_get_contents($paidImagePath));
//        $paidImageSrc = 'data:image/png;base64,' . $paidImageData;
//        // Convert the image to a base64 string
//
//        $unpaidImagePath = asset('front/assets/images/unpaid.png');
//        $unpaidImageData = base64_encode(file_get_contents($unpaidImagePath));
//        $unpaidImageSrc = 'data:image/png;base64,' . $unpaidImageData;
//
//        if (!$order) {
//            abort(404, 'Order not found');
//        }
//        $pdf = Pdf::loadView('front.invoice.invoice', [
//            'order' => $order,
//            'imageSrc' => $imageSrc,
//            'paidImageSrc' => $paidImageSrc,
//            'unpaidImageSrc' => $unpaidImageSrc
//        ]);
//        $code = $order->order_code;
//        return $pdf->download("{$code}_invoice.pdf");
//
////        return view('front.invoice.invoice', [
////            'order' => $order,
////            'imageSrc' => $imageSrc,
////            'paidImageSrc' => $paidImageSrc,
////            'unpaidImageSrc' => $unpaidImageSrc
////        ]);
//
////        $pdf = App::make('dompdf.wrapper');
////        $pdf->loadHTML('<h1>Test</h1>');
////        return $pdf->stream();
//    }

    public function generatePdf($id) {

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'UTF-8',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'default_font' => 'nikosh',
            'default_font_size' => 10
        ]);
        $order = Order::find($id);
        $setting = GeneralSetting::latest()->first();
        // Convert the image to a base64 string
        $imagePath = asset($setting->header_logo);
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Convert the image to a base64 string
        $paidImagePath = asset('front/assets/images/apaid.png');
        $paidImageData = base64_encode(file_get_contents($paidImagePath));
        $paidImageSrc = 'data:image/png;base64,' . $paidImageData;
        // Convert the image to a base64 string

        $unpaidImagePath = asset('front/assets/images/unpaid.png');
        $unpaidImageData = base64_encode(file_get_contents($unpaidImagePath));
        $unpaidImageSrc = 'data:image/png;base64,' . $unpaidImageData;

        if (!$order) {
            abort(404, 'Order not found');
        }
        $pdf = view('front.invoice.invoice', [
            'order' => $order,
            'imageSrc' => $imageSrc,
            'paidImageSrc' => $paidImageSrc,
            'unpaidImageSrc' => $unpaidImageSrc
        ])->render();
        $code = $order->order_code;
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
//        $mpdf->Output($code . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }
}
