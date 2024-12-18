<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Privacy;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Cart;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('front.home.home');
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

}
