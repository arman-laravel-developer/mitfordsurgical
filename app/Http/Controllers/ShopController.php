<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request,$id)
    {
        $products = Product::where('user_id', $id)->latest()->paginate(20);
        if ($request->ajax()) {
            $view = view('front.inc.all-products', compact('products'))->render();
            return response()->json(['html' => $view]);
        }
        $shop = Shop::where('seller_id',$id)->first();
        return view('front.seller.shop', compact('products', 'shop'));
    }
}
