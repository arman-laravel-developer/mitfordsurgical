<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Cache;

class LanguageController extends Controller
{
    public function index()
    {
        return view('admin.setup-configuration.language.index');
    }

    public function manage()
    {
        $languages = Language::latest()->get();
        return view('admin.setup-configuration.language.manage', compact('languages'));
    }

    public function create(Request $request)
    {
        $language = new Language;
        $language->name = $request->name;
        $language->code = $request->code;
        $language->app_lang_code = $request->app_lang_code;
        $language->save();

        Cache::forget('app.languages');

        return redirect()->route('language.manage')->with('success', 'Language has been inserted successfully');
    }
    public function edit($id)
    {
        $language = Language::find($id);
        return view('admin.setup-configuration.language.edit', compact('language'));
    }

    public function delete($id)
    {
        $language = Language::find($id);
        $language->delete();
        return redirect()->back()->with('Language delete Successfully');
    }
}
