<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index()
    {
        return view('front.seller.product.index');
    }
    public function manage()
    {
        return view('front.seller.product.manage');
    }
}
