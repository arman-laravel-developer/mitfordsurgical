<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class CouponController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->latest()->get();
        return view('admin.coupon.index', compact('products'));
    }

    public function create(Request $request)
    {
        if(count(Coupon::where('code', $request->p_code)->orWhere('code', $request->c_code)->get()) > 0){
            return back()->with('error', 'Coupon already exist for this coupon code');
        }

        $coupon = new Coupon;
        $coupon->user_id = Auth::user()->id;
        $coupon = $this->setCouponData($request, $coupon);
        $coupon->save();

        return redirect()->back()->with('success', 'Coupon has been saved successfully');
    }

    public function manage()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.manage', compact('coupons'));
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $products = Product::where('status', 1)->latest()->get();
        return view('admin.coupon.edit', compact('coupon', 'products'));
    }

    public function update(Request $request, $id)
    {
        $exists = Coupon::where('id', '!=', $id)
            ->where(function($query) use ($request) {
                $query->where('code', $request->p_code)
                    ->orWhere('code', $request->c_code);
            })
            ->exists();

        if ($exists) {
            return back()->with('error', 'Coupon already exists for this coupon code');
        }

        $coupon = Coupon::findOrFail($id);
        $this->setCouponData($request, $coupon);
        $coupon->save();

        return redirect()->back()->with('success', 'Coupon has been updated successfully');
    }

    public function delete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()->back()->with('success', 'Coupon has been delete successfully');
    }

    public function setCouponData($request, $coupon){
        if ($request->type == "product_base") {
            $coupon->type = $request->type;
            $coupon->code = $request->p_code;
            $coupon->discount = $request->p_discount;
            $coupon->discount_type = $request->p_discount_type;
            $dates = explode(' - ', $request->p_discount_date_range);
            $start_date = $dates[0];
            $end_date = $dates[1];
            $start_date_format = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
            $end_date_format = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
            $coupon->start_date       = $start_date_format;
            $coupon->end_date         = $end_date_format;
            $cupon_details = [];
            foreach($request->product_ids as $product_id) {
                $data['product_id'] = $product_id;
                array_push($cupon_details, $data);
            }
            $coupon->details = json_encode($cupon_details);
            if ($request->p_status)
            {
                $coupon->is_active = $request->p_status;
            }
            else
            {
                $coupon->is_active = 0;
            }

        } elseif ($request->type == "cart_base") {
            $coupon->type             = $request->type;
            $coupon->code             = $request->c_code;
            $coupon->discount         = $request->c_discount;
            $coupon->discount_type    = $request->c_discount_type;
            $dates = explode(' - ', $request->c_discount_date_range);
            $start_date = $dates[0];
            $end_date = $dates[1];
            $start_date_format = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
            $end_date_format = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
            $coupon->start_date       = $start_date_format;
            $coupon->end_date         = $end_date_format;
            $data                     = [];
            $data['minimum_buy']          = $request->minimum_buy;
            $data['maximum_discount']     = $request->maximum_discount;
            $coupon->details          = json_encode($data);
            if ($request->c_status)
            {
                $coupon->is_active = $request->c_status;
            }
            else
            {
                $coupon->is_active = 0;
            }
        }

        return $coupon;
    }
}
