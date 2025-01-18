<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Order;
use Illuminate\Http\Request;
use Session;

class SellerDashboardController extends Controller
{
    public function index()
    {
        return view('front.seller.dashboard');
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
            'unpaidImageSrc' => $unpaidImageSrc
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
