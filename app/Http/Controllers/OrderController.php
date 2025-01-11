<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|regex:/^[0-9]{11}$/', // Validates an 11-digit phone number
            'address' => 'required|string|max:255',
            'shipping_cost' => 'required|numeric', // Ensure a valid shipping cost is selected
            'payment_method' => 'required|string|in:cod', // Ensure it's "cod" for Cash on Delivery
            'agree_policy' => 'required|accepted', // Ensure the user agrees to the terms
        ], [
            // Custom error messages for validation rules
            'name.required' => 'The full name is required.',
            'name.string' => 'The full name must be a valid string.',
            'name.max' => 'The full name should not exceed 255 characters.',

            'mobile.required' => 'The phone number is required.',
            'mobile.regex' => 'The phone number must be exactly 11 digits.',

            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a valid string.',
            'address.max' => 'The address should not exceed 255 characters.',

            'shipping_cost.required' => 'Please select a valid shipping option.',
            'shipping_cost.numeric' => 'The shipping cost must be a valid numeric value.',

            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'The selected payment method must be "Cash on Delivery" (COD).',

            'agree_policy.required' => 'You must agree to the terms and conditions.',
            'agree_policy.accepted' => 'You must accept the terms and conditions to proceed.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Redirect back with input to repopulate the form
        }

        // Handle the order submission
        try {
            // Your order creation logic
            // Example: Order::create($validatedData);

            return redirect()->route('home'); // Redirect to success page after order is placed
        } catch (\Exception $e) {
            // Handle errors
            return back()->withErrors(['error' => 'Something went wrong while placing the order.']);
        }
    }
}
