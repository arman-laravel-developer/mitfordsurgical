<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SellerDashboardController extends Controller
{
    public function index()
    {
        return view('front.seller.dashboard');
    }

    public function logout()
    {
        Session::forget('seller_id');
        Session::forget('seller_name');

        return redirect()->route('home')->with('success', 'You have been logged out successfully');
    }
}
