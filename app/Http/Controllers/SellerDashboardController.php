<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $sellerId = Session::get('seller_id');
        $sellerPendingProducts = Product::where('user_id', $sellerId)->where('status', 2)->get();
        $sellerPublishedProducts = Product::where('user_id', $sellerId)->where('status', 1)->get();
        $sellerRejectProducts = Product::where('user_id', $sellerId)->where('status', 3)->get();
        $pendingOrders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'pending')->get();
        $deliveredOrders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'delivered')->sum('grand_total');
        $totalSales = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'delivered')->get();
        // Assuming you have these values
        $recentOrdersCount = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('created_at', '>=', Carbon::now()->subDays(3))->count();

        $totalOrders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->count();

        $receivedPaymentsCount = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'received_payment')->count();

        $completeOrdersCount = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'delivered')->count();
        return view('front.seller.dashboard', compact(
            'sellerPendingProducts',
            'sellerPublishedProducts',
            'sellerRejectProducts',
            'pendingOrders',
            'deliveredOrders',
            'totalSales',
            'recentOrdersCount',
            'totalOrders',
            'receivedPaymentsCount',
            'completeOrdersCount'
        ));
    }

    public function invoice($id)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'UTF-8',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'default_font' => 'nikosh',
        ]);
        $sellerId = Session::get('seller_id');
        $order = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('id', $id) // Filter by specific order ID
            ->first();
        $shop = Shop::where('seller_id', $sellerId)->first();
        $seller = Seller::find($sellerId);

        $setting = GeneralSetting::latest()->first();
        // Convert the image to a base64 string
        $imagePath = asset($setting->header_logo);
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Convert the image to a base64 string
        $paidImagePath = asset('front/assets/images/paid.png');
        $paidImageData = base64_encode(file_get_contents($paidImagePath));
        $paidImageSrc = 'data:image/png;base64,' . $paidImageData;
        // Convert the image to a base64 string

        $unpaidImagePath = asset('front/assets/images/unpaid.png');
        $unpaidImageData = base64_encode(file_get_contents($unpaidImagePath));
        $unpaidImageSrc = 'data:image/png;base64,' . $unpaidImageData;

        if (!$order) {
            abort(404, 'Order not found');
        }
        $pdf = view('front.invoice.seller-invoice', [
            'order' => $order,
            'imageSrc' => $imageSrc,
            'paidImageSrc' => $paidImageSrc,
            'unpaidImageSrc' => $unpaidImageSrc,
            'shop' => $shop,
            'seller' => $seller
        ])->render();
        $code = $order->order_code;
        $mpdf->WriteHTML($pdf);
//        $mpdf->Output();
        $mpdf->Output($code . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function logout()
    {
        Session::forget('seller_id');
        Session::forget('seller_name');

        return redirect()->route('home')->with('success', 'You have been logged out successfully');
    }
}
