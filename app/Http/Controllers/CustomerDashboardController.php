<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customer = Customer::find(Session::get('customer_id'));
        return view('front.customer.dashboard', compact('customer'));
    }

    public function logout()
    {
        Session::forget('customer_id');
        Session::forget('customer_name');
        Session::forget('active_tab');

        return redirect()->route('home')->with('success', 'You have been logged out successfully');
    }

    public function getImageUrl($request)
    {
        $image = $request->file('profile_img');
        $slug = Str::slug($request->name);
        // Set the image name and directory
        $imageName = $slug.'-'.time().'.'.$image->getClientOriginalExtension();
        $directory = 'customer-profile-images/';
        $imageUrl = $directory.$imageName;
        // Create the directory if it doesn't exist
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // Create an Intervention Image instance
        $img = \Intervention\Image\Facades\Image::make($image->getRealPath());
        $img->resize(491, 491);
        $img->save($imageUrl);
        return $imageUrl;
    }

    public function profileImageUpdate(Request $request)
    {
        $request->validate([
            'profile_img' => 'nullable|mimes:jpeg,jpg,png|max:2048', // accepts jpg, jpeg, png, up to 2MB
        ]);


        $customer = Customer::find(Session::get('customer_id'));

        if ($request->file('profile_img'))
        {
            // Delete the old profile image if it exists
            if (file_exists($customer->profile_img))
            {
                unlink($customer->profile_img);
            }

            // Get the new image URL after validation
            $imageUrl = $this->getImageUrl($request);
        }
        else
        {
            $imageUrl = $customer->profile_img;
        }

        // Update the profile image in the database
        $customer->profile_img = $imageUrl;
        $customer->save();

        return redirect()->back()->with('success', 'Profile update successful');
    }

    public function profileUpdate(Request $request)
    {
        $customer = Customer::find(Session::get('customer_id'));
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->save();

        return redirect()->back()->with('success', 'Profile update successfull');
    }

    public function storeActiveTab(Request $request)
    {
        $request->validate([
            'active_tab' => 'required|string',
        ]);

        // Store the active tab in session
        session(['active_tab' => $request->active_tab]);

        return response()->json(['message' => 'Active tab stored']);
    }

    public function passwordUpdate(Request $request)
    {
        // Validate input data
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'old_password.required' => 'The current password is required.',
            'password.required' => 'The new password is required.',
            'password.min' => 'The new password must be at least 6 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);
        $customer = Customer::find(Session::get('customer_id'));

        if (password_verify($request->old_password, $customer->password))
        {
            $customer->password = bcrypt($request->password);
            $customer->save();

            flash()->success('Password update', 'Password change successfull');
            return redirect()->back();
        }
        else
        {
            flash()->error('Password update', 'Incorrect password');
            return redirect()->back();
        }
    }
}
