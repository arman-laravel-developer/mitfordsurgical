<?php

namespace App\Http\Controllers;

use App\Models\ReturnAndRefund;
use App\Models\ReturnAndRefundTranslation;
use Illuminate\Http\Request;

class ReturnAndRefundController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->lang;
        $return = ReturnAndRefund::first();
        return view('admin.return.index', compact('return', 'lang'));
    }

    public function update(Request $request)
    {
        $return = ReturnAndRefund::latest()->first();
        if ($request->lang == 'en')
        {
            if ($return)
            {
                $return->return = $request->return;
                $return->save();

                $return_translation = ReturnAndRefundTranslation::firstOrNew(['lang' => $request->lang, 'return_and_refund_id' => $return->id]);
                $return_translation->return = $request->return;
                $return_translation->save();
            }
            else
            {
                $return = new ReturnAndRefund();
                $return->return = $request->return;
                $return->save();

                $return_translation = ReturnAndRefundTranslation::firstOrNew(['lang' => $request->lang, 'return_and_refund_id' => $return->id]);
                $return_translation->return = $request->return;
                $return_translation->save();
            }
        }
        else
        {
            $return_translation = ReturnAndRefundTranslation::firstOrNew(['lang' => $request->lang, 'return_and_refund_id' => $return->id]);
            $return_translation->return = $request->return;
            $return_translation->save();
        }
        return redirect()->back()->with('success', 'Return And Refund update successfully');
    }

    public function page_view()
    {
        $return = ReturnAndRefund::first();
        return view('front.privacy.return', compact('return'));
    }
}
