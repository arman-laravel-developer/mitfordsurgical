<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            // Retrieve product by ID
            $product = Product::find($request->input('product_id'));

            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
            }

            // Retrieve input values
            $size_id = $request->input('size_id');
            $color_id = $request->input('color_id');
            $variant_id = $request->input('variant_id');
            $quantity = $request->input('quantity', $product->minimum_purchase_qty);
            $price = $request->input('price');
            $thumbnailImage = $request->input('thumbnail_image', $product->thumbnail_img);

            // Retrieve current cart items
            $cartItems = Cart::getContent();
            $itemToUpdate = null;

            // Check if item with the same ID and size already exists in the cart
            foreach ($cartItems as $item) {
                if ($item->attributes->product_id == $product->id && $item->attributes->variant_id == $variant_id) {
                    $itemToUpdate = $item;
                    break;
                }
            }

            if ($itemToUpdate) {
                // Update quantity if item exists
                Cart::update($itemToUpdate->id, array(
                    'quantity' => $quantity, // Set quantity directly from the request
                ));
            } else {
                // Add new item to the cart
                Cart::add(array(
                    'id' => uniqid(), // Unique identifier for the new item
                    'name' => $product->name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'attributes' => array(
                        'product_id' => $product->id,
                        'size_id' => $size_id,
                        'color_id' => $color_id,
                        'variant_id' => $variant_id,
                        'discount' => $product->discount,
                        'discount_type' => $product->discount_type,
                        'thumbnail_image' => $thumbnailImage,
                    ),
                ));
            }

            $cartProducts = Cart::getContent();
            $total = Cart::getTotal();
            $cartCount = count(Cart::getContent());

            return response()->json([
                'success' => true,
                'message' => 'Item added to cart successfully!',
                'item' => $cartCount,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function dropdown()
    {
        $cartContents = Cart::getContent();
        $total = Cart::getTotal();
        $cartCount = count(Cart::getContent());
        return view('front.partials.cart-dropdown', compact('cartContents', 'total', 'cartCount'));
    }

    public function updateQuantity(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $newQuantity = $request->input('quantity');

            Cart::update($productId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $newQuantity
                ),
            ));

            $cart = Cart::getContent();
            $subtotal = Cart::getSubTotal();
            $total = Cart::getTotal();
            $rowTotal = $cart[$productId]->price * $newQuantity;
            $cartCount = count(Cart::getContent());

            return response()->json([
                'success' => true,
                'subtotal' => $subtotal,
                'total' => $total,
                'cartCount' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function cartRemove(Request $request)
    {
        $itemId = $request->input('itemId');
        try {
            // Remove the product from the cart
            Cart::remove($itemId);

            // Get the updated total
            $total = Cart::getTotal();
            $cartCount = count(Cart::getContent());

            return response()->json(['success' => true, 'total' => $total, 'cartCount' => $cartCount]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
