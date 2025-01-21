<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShippingCost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;
use Session;

class CheckoutController extends Controller
{
    public function index()
    {
//        $c = Session::get('cartTotalNew');
//        dd($c);
        $cartProducts = Cart::getContent();
        $shippingCosts = ShippingCost::orderBy('id', 'asc')->get();
        if (Session::get('cartTotalNew'))
        {
            Session::forget('cartTotalNew');
        }
        if (Session::get('selectedShippingCost'))
        {
            Session::forget('selectedShippingCost');
        }
        if (count($cartProducts) > 0) {
            foreach ($cartProducts as $cartProduct) {
                $product = Product::find($cartProduct->attributes->product_id);

                // Check if the product is a variant
                if ($product->is_variant == 1) {
                    foreach ($product->variants as $variant) {
                        if ($cartProduct->attributes->variant_id == $variant->id) {
                            // If quantity exceeds the available stock for the variant
                            if ($cartProduct->quantity > $variant->qty) {
                                $excessQuantity = $cartProduct->quantity - $variant->qty;
                                if ($excessQuantity > 0) {
                                    Cart::update($cartProduct->id, [
                                        'quantity' => -$excessQuantity
                                    ]);
                                }
                                session()->flash('info', "The quantity for {$product->name} has been adjusted to the available stock.");
                            }
                            break; // Exit the loop once the variant is found
                        }
                    }
                } else {
                    // If the product is not a variant, check its stock
                    if ($cartProduct->quantity > $product->stock) {
                        $excessQuantity = $cartProduct->quantity - $product->stock;
                        if ($excessQuantity > 0) {
                            Cart::update($cartProduct->id, [
                                'quantity' => -$excessQuantity
                            ]);
                        }
                        session()->flash('info', "The quantity for {$product->name} has been adjusted to the available stock.");
                    }
                }
                $cartTotal = Cart::getTotal();
            }
            return view('front.pages.checkout', compact('cartProducts', 'cartTotal', 'shippingCosts'));
        }
        else
        {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon');
        $cartTotal = Cart::getTotal(); // Example cart total
        $carts = Cart::getContent(); // Example cart total
        $currentDate = Carbon::now()->format('Y-m-d');
        if (Session::get('selectedShippingCost'))
        {
            $shippingCost = Session::get('selectedShippingCost');
        }
        else
        {
            $shippingCost = 0;
        }
        // Check if the coupon exists, is active, and within the date range
        $coupon = Coupon::where('code', $couponCode)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->first();


        if ($coupon) {
            $coupon_details = json_decode($coupon->details);
            if ($coupon->type == 'cart_base') {
                $subtotal = 0;
                foreach ($carts as $key => $cartItem) {
                    $subtotal += $cartItem->price * $cartItem->quantity;
                }
                if ($subtotal < $coupon_details->minimum_buy) {
                    return response()->json(['success' => false, 'message' => 'Minimum purchase requirement not met']);
                }
                if ($subtotal >= $coupon_details->minimum_buy) {
                    if ($coupon->discount_type == 2) {
                        $coupon_discount = ($subtotal * $coupon->discount) / 100;
                        if ($coupon_discount > $coupon_details->maximum_discount) {
                            $coupon_discount = $coupon_details->maximum_discount;
                        }
                    } elseif ($coupon->discount_type == 1) {
                        $coupon_discount = $coupon->discount;
                    }
                }
            } elseif ($coupon->type == 'product_base') {
                $coupon_discount = 0;
                foreach ($carts as $key => $cartItem) {
                    foreach ($coupon_details as $key => $coupon_detail) {
                        if ($coupon_detail->product_id == $cartItem->attributes->product_id) {
                            if ($coupon->discount_type == 2) {
                                $coupon_discount += ($cartItem->price * $coupon->discount / 100) * $cartItem->quantity;
                            } elseif ($coupon->discount_type == 1) {
                                $coupon_discount += $coupon->discount * $cartItem->quantity;
                            }
                        }
                    }
                }
            }
            $cartTotal = $cartTotal - $coupon_discount + $shippingCost;

            Session::put('cartTotalNew', $cartTotal);
            return response()->json([
                'success' => true,
                'newTotal' => $cartTotal,
                'couponDiscount' => $coupon_discount,
                'couponCodeShow' => $couponCode
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid or Expired Coupon Code']);
        }
    }

    public function removeCoupon()
    {
        session()->forget('cartTotalNew');
        $newTotal = Cart::getTotal();
        return response()->json(['success' => true, 'newTotal' => $newTotal]);
    }

    public function getCartTotal()
    {
        if (Session::get('cartTotalNew'))
        {
            $cartTotal = Session::get('cartTotalNew');
        }
        else
        {
            $cartTotal = Cart::getTotal();
        }
        return response()->json([
            'cartTotal' => $cartTotal
        ]);
    }
}
