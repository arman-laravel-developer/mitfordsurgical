<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {

        return view('front.home.home');
    }


}
