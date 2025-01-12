<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Cart;
use Session;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|regex:/^[0-9]{11}$/', // Validates an 11-digit phone number
            'address' => 'required|string|max:255',
            'shipping_cost' => 'required|numeric', // Ensure a valid shipping cost is selected
            'payment_method' => 'required|string|in:cod', // Ensure it's "cod" for Cash on Delivery
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
        $order->total_qty = $quantity;
        $order->address = $request->address;
        $order->shipping_cost = $shipping_cost;
        $order->order_note = $request->order_note;
        $order->city_id = $request->city_id;
        $order->payment_method = $request->payment_method;
        $order->order_status = 'pending';
        $order->delivery_status = 'pending';
        $order->payment_method = $request->payment_method;
        $order->save();
        if ($request->payment_method == 'cod')
        {
            $payment_history = new PaymentHistory();
            $payment_history->order_id = $order->id;
            $payment_history->payment_method = 'cash on delivery';
            $payment_history->payment_status = 'pending';
            $payment_history->amount = $order_total + $shipping_cost;
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
}
