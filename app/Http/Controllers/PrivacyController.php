<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use App\Models\PrivacyTranslation;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PrivacyController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->lang;
        $privacy = Privacy::where('status', 1)->first();
        return view('admin.privacy.edit', compact('privacy', 'lang'));
    }

    public function update(Request $request)
    {
        $privacy = Privacy::latest()->first();
        if ($request->lang == 'en')
        {
            if ($privacy)
            {
                $privacy->privacy = $request->privacy;
                $privacy->condition = $request->condition;
                $privacy->save();

                $privacy_translation = PrivacyTranslation::firstOrNew(['lang' => $request->lang, 'privacy_id' => $privacy->id]);
                $privacy_translation->privacy = $request->privacy;
                $privacy_translation->condition = $request->condition;
                $privacy_translation->save();
            }
            else
            {
                $privacy = new Privacy();
                $privacy->privacy = $request->privacy;
                $privacy->condition = $request->condition;
                $privacy->save();

                $privacy_translation = PrivacyTranslation::firstOrNew(['lang' => $request->lang, 'privacy_id' => $privacy->id]);
                $privacy_translation->privacy = $request->privacy;
                $privacy_translation->condition = $request->condition;
                $privacy_translation->save();
            }
        }
        else
        {
            $privacy_translation = PrivacyTranslation::firstOrNew(['lang' => $request->lang, 'privacy_id' => $privacy->id]);
            $privacy_translation->privacy = $request->privacy;
            $privacy_translation->condition = $request->condition;
            $privacy_translation->save();
        }
        return redirect()->back()->with('success', 'Privacy update successfully');
    }

    public function page_view()
    {
        $privacy = Privacy::where('status', 1)->first();
        return view('front.privacy.privacy', compact('privacy'));
    }

    public function condition_page_view()
    {
        $privacy = Privacy::where('status', 1)->first();
        return view('front.privacy.conditions', compact('privacy'));
    }
}

