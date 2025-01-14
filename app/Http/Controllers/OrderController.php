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
    public function confirmed()
    {
        $orders = Order::where('order_status', 'confirmed')->orderBy('id', 'desc')->get();
        return view('admin.order.confirmed', compact('orders'));
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
        $order->payment_status = 'pending';
        $order->delivery_status = 'pending';
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

        return redirect()->back()->with('success', 'Order status update successfull');
    }

    public function generatePDF()
    {
        // Load the view and pass data to it (if any)
        $pdf = PDF::loadView('front.pdf.template');

        return view('front.pdf.template');
        // Stream the generated PDF to the browser
        return $pdf->stream('sample.pdf');

        // To download the PDF as a file, use:
        // return $pdf->download('sample.pdf');
    }
}
