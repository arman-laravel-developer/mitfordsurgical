<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Session;
class SellerOrderController extends Controller
{
    public function index()
    {
        // Get the seller_id from session
        $sellerId = Session::get('seller_id');

// Fetch orders where products' user_id matches the seller_id
        $orders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->latest()->paginate(10);
        return view('front.seller.order.all-order', compact('orders'));
    }
    public function pending()
    {
        // Get the seller_id from session
        $sellerId = Session::get('seller_id');

// Fetch orders where products' user_id matches the seller_id
        $orders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'pending')->latest()->paginate(10);
        return view('front.seller.order.pending', compact('orders'));
    }
    public function delivered()
    {
        // Get the seller_id from session
        $sellerId = Session::get('seller_id');

// Fetch orders where products' user_id matches the seller_id
        $orders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'delivered')->latest()->paginate(10);
        return view('front.seller.order.delivered', compact('orders'));
    }
    public function canceled()
    {
        // Get the seller_id from session
        $sellerId = Session::get('seller_id');

// Fetch orders where products' user_id matches the seller_id
        $orders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'cancel')->latest()->paginate(10);
        return view('front.seller.order.pending', compact('orders'));
    }

    public function getOrdersBySeller($sellerId)
    {
        $orders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->where('order_status', 'delivered')->get();

        return response()->json($orders);
    }
}
