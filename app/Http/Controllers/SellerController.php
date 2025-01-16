<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        if (!Session::get('customer_id')) {
            $request->validate([
                'name' => 'required|max:255',
                'password' => 'required|confirmed|min:6',
                'mobile' => 'required|unique:sellers|regex:/^(\+88)?01[3-9]\d{8}$/',
                'email' => 'required|unique:sellers',
            ]);
        }

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
        if (Session::get('customer_id'))
        {
            $customer = Customer::find(Session::get('customer_id'));
            $seller->password = $customer->password;
        }
        else
        {
            $seller->password = bcrypt($request->password);
        }
        $seller->save();

        $shop = new Shop();
        $shop->shop_name = $request->shop_name;
        $shop->slug = Str::slug($request->shop_name);
        $shop->address = $request->shop_address;
        $shop->seller_id = $seller->id;
        $shop->save();

        Session::put('seller_id', $seller->id);
        Session::put('seller_name', $request->name);

        if (Session::get('customer_id'))
        {
            $customer = Customer::find(Session::get('customer_id'));
            if (file_exists($customer->profile_img))
            {
                unlink($customer->profile_img);
            }
            $customer->delete();

            Session::forget('customer_id');
            Session::forget('name');
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

    public function getImageUrl($request)
    {
        $slug = Str::slug($request->shop_name);
        $image = $request->file('tax_papers');
        $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        $directory = 'tax-papers/';
        $image->move($directory,$imageName);
        $imageUrl = $directory.$imageName;
        return $imageUrl;
    }

    public function verify_form_store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'shop_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'trade_license_no' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'tax_papers' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // File validation
        ]);

        // Prepare data for saving
        $data = [];

        // Add input fields with types
        $data[] = [
            'label' => 'Full Name',
            'value' => $request->name,
            'type'  => 'text',
        ];
        $data[] = [
            'label' => 'Shop Name',
            'value' => $request->shop_name,
            'type'  => 'text',
        ];
        $data[] = [
            'label' => 'Email Address',
            'value' => $request->email,
            'type'  => 'email',
        ];
        $data[] = [
            'label' => 'Trade License No',
            'value' => $request->trade_license_no,
            'type'  => 'text',
        ];
        $data[] = [
            'label' => 'Full Address',
            'value' => $request->address,
            'type'  => 'textarea',
        ];
        $data[] = [
            'label' => 'Phone Number',
            'value' => $request->phone,
            'type'  => 'tel',
        ];

        // Handle file upload with type
        if ($request->hasFile('tax_papers')) {
            $data[] = [
                'label' => 'Tax Papers',
                'value' => $this->getImageUrl($request),
                'type'  => 'file',
            ];
        }

        // Save verification info to the seller
        $seller = Seller::find(Session::get('seller_id'));
        if ($seller) {
            $seller->verification_info = json_encode($data);
            $seller->is_verified = 3;
            $seller->verification_status = 3;
            if ($seller->save()) {
                return redirect()->route('seller.dashboard')->with('success', translate('Your shop verification request has been submitted successfully!'));
            }
        }

        return back()->with('error', translate('Sorry! Something went wrong.'));
    }

    public function pending()
    {
        $sellers = Seller::whereIn('is_verified', [2, 3])->latest()->get();
        return view('admin.sellers.pending', compact('sellers'));
    }
    public function approved()
    {
        $sellers = Seller::where('is_verified', 1)->latest()->get();
        return view('admin.sellers.approved', compact('sellers'));
    }
    public function ban()
    {
        $sellers = Seller::where('status', 2)->latest()->get();
        return view('admin.sellers.ban', compact('sellers'));
    }
    public function detail($id)
    {
        $seller = Seller::find($id);
        return view('admin.sellers.detail', compact('seller'));
    }

    public function approval(Request $request, $id)
    {
        $seller = Seller::find($id);
        if ($request->button == 1) {
            $seller->is_verified = 1;
            $seller->verification_status = 1;
            $message = 'Seller approved successfully!';
        } else {
            $seller->is_verified = 2;
            $seller->verification_status = 2;
            $seller->verification_info = null;
            $message = 'Seller rejected successfully!';
        }
        $seller->save();

        return redirect()->back()->with('success', $message);
    }

    public function changeStatus(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $seller->status = $request->input('status'); // 1 = Banned, 2 = Unbanned
        $seller->save();

        return redirect()->back()->with('success', 'Seller status updated successfully.');
    }


}
