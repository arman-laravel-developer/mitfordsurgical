<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Privacy;
use App\Models\Product;
use App\Models\ReturnAndRefund;
use App\Models\Slider;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Variant;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Cart;

class HomeController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        $featuredProducts = Product::where('status', 1)->where('is_featured', 1)->latest()->take(10)->get();
        $products = Product::where('status', 1)->latest()->get();
        $sliders = Slider::where('status',1)->latest()->take(5)->get();
        $homeCategories = Category::where('status',1)->where('display_status',1)->latest()->take(10)->get();
        return view('front.home.home', compact('sliders', 'homeCategories', 'products', 'featuredProducts'));
    }

    public function detail($id)
    {
        $product = Product::find($id);
        $relatedProducts = Product::where('status', 1)->where('category_id', $product->category_id)->take(24)->latest()->get();
        return view('front.pages.show', compact('product', 'relatedProducts'));
    }

    public function aboutUs()
    {
        $about = AboutUs::latest()->first();
        return view('front.pages.about', compact('about'));
    }

    public function contactUs()
    {
        return view('front.pages.contact');
    }

    public function privacy()
    {
        $privacy = Privacy::latest()->first();
        return view('front.privacy.privacy', compact('privacy'));
    }

    public function condition()
    {
        $condition = Privacy::latest()->first();
        return view('front.privacy.conditions', compact('condition'));
    }
    public function returnPage()
    {
        $return = ReturnAndRefund::latest()->first();
        return view('front.privacy.return', compact('return'));
    }

    public function getVariant(Request $request)
    {
        // Check if both color_id and size_id are provided
        if ($request->color_id && $request->size_id) {
            $variant = Variant::where('product_id', $request->product_id)
                ->where('color_id', $request->color_id)
                ->where('size_id', $request->size_id)
                ->first();
        }
        // If only color_id is provided
        elseif ($request->color_id) {
            $variant = Variant::where('product_id', $request->product_id)
                ->where('color_id', $request->color_id)
                ->first();
        }
        // If only size_id is provided
        elseif ($request->size_id) {
            $variant = Variant::where('product_id', $request->product_id)
                ->where('size_id', $request->size_id)
                ->first();
        }

        if ($variant) {
            return response()->json(['variant' => $variant]);
        } else {
            return response()->json(['price' => 'N/A'], 404);
        }
    }


}
