<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Session;
use DB;

class SellerController extends Controller
{
    public function register()
    {
        if (Session::get('customer_id'))
        {
            $customer = Customer::find(Session::get('customer_id'));
            return view('front.seller.register', compact('customer'));
        }
        else
        {
            return view('front.seller.register');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
            'mobile' => 'required|unique:sellers|regex:/^(\+88)?01[3-9]\d{8}$/',
            'email' => 'required|unique:sellers',
        ]);

        if (!Session::get('customer_id')) {
            // Check if the email or mobile exists in the customers table
            $existingCustomer = DB::table('customers')
                ->where('email', $request->email)
                ->orWhere('mobile', $request->mobile)
                ->first();

            if ($existingCustomer) {
                flash()->error('Registration failed', 'You are already registered as a customer.');
                return redirect()->back()->withInput();
            }
        }

        $seller = new Seller();
        $seller->name = $request->name;
        $seller->email = $request->email; // Fixed to use $request->email
        $seller->mobile = $request->mobile;
        $seller->password = bcrypt($request->password);
        $seller->save();

        $shop = new Shop();
        $shop->shop_name = $request->shop_name;
        $shop->address = $request->shop_address;
        $shop->seller_id = $seller->id;
        $shop->save();

        Session::put('seller_id', $seller->id);
        Session::put('seller_name', $request->name);

        if (Session::get('customer_id'))
        {
            Session::forget('customer_id');
            Session::forget('name');
            $customer = Customer::find(Session::get('customer_id'));
            if (file_exists($customer->profile_img))
            {
                unlink($customer->profile_img);
            }
            $customer->delete();
        }

        flash()->success('Registration complete', 'You have been logged in successfully');
        return redirect()->route('seller.dashboard');
    }

    public function login()
    {
        return view('front.seller.login');
    }

    public function verify()
    {
        $seller = Seller::find(Session::get('seller_id'));
        if ($seller->is_verified == 1)
        {
            return redirect()->route('seller.dashboard')->with('success', 'You are already verified');
        }
        return view('front.seller.verify');
    }

    public function loginCheck(Request $request)
    {
        // Attempt to find the customer by email or mobile
        $seller = Seller::where('email', $request->mobile)->orWhere('mobile', $request->mobile)->first();
//        dd($customer);
        if ($seller) {
            // Check if the provided password matches the stored hashed password
            if (password_verify($request->password, $seller->password)) {
                // Store customer details in the session
                Session::put('seller_id', $seller->id);
                Session::put('seller_name', $seller->name);

                // Flash success message and redirect to dashboard
                flash()->success('Login successful', 'You have been logged in.');
                return redirect()->route('seller.dashboard');
            } else {
                // Flash error message for incorrect password
                flash()->error('Login unsuccessful', 'Your email or password is incorrect.');
                return redirect()->back();
            }
        } else {
            // Flash error message for not found customer
            flash()->error('Login unsuccessful', 'Your email or password is incorrect.');
            return redirect()->back();
        }
    }
}
