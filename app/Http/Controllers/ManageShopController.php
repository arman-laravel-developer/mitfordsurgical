<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class ManageShopController extends Controller
{
    public function index()
    {
        $shop = Shop::where('seller_id', Session::get('seller_id'))->first();
        return view('front.seller.manage-shop', compact('shop'));
    }

    public function getLogoUrl($request)
    {
        $slug = Str::slug($request->shop_name);
        $logo = $request->file('logo');
        $logoName = $slug.'-'.uniqid().'.'.$logo->getClientOriginalExtension();
        $directory = 'shop-logos/';
        $logo->move($directory,$logoName);
        $logoUrl = $directory.$logoName;
        return $logoUrl;
    }

    public function getBannerUrl($request)
    {
        $slug = Str::slug($request->shop_name);
        $banner = $request->file('banner');
        $bannerName = $slug.'-'.uniqid().'.'.$banner->getClientOriginalExtension();
        $directory = 'banner-logos/';
        $banner->move($directory,$bannerName);
        $bannerUrl = $directory.$bannerName;
        return $bannerUrl;
    }

    public function update(Request $request)
    {
        $slug = Str::slug($request->shop_name);
        $shop = Shop::find($request->shop_id);
        $shop->slug = $slug;
        $shop->shop_name = $request->shop_name;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->facebook = $request->facebook;
        $shop->twitter = $request->twitter;
        $shop->google = $request->google;
        $shop->youtube = $request->youtube;
        $shop->meta_title = $request->meta_title;
        $shop->meta_description = $request->meta_description;
        $shop->save();

        return redirect()->back()->with('success', 'Shop information update successfully');
    }
}
