<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShippingCost;
use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartProducts = Cart::getContent();
        $shippingCosts = ShippingCost::orderBy('id', 'asc')->get();

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
}
