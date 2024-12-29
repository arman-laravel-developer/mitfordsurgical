<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use Cache;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        // Validate the locale input
        $request->validate([
            'locale' => 'required|string|exists:languages,code', // Check if 'languages' table has the code
        ]);

        $locale = $request->locale;

        // Set the application locale for the current request
        app()->setLocale($locale);

        // Update the config dynamically at runtime
        config(['app.locale' => $locale]);

        // Store the locale in the session for persistence
        $request->session()->put('locale', $locale);

        // Optionally flash a success message
        $language = Language::where('code', $locale)->first();
        session()->flash('success', 'Language changed to ' . $language->name);

        return response()->json(['message' => 'Language changed successfully']);
    }


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

    public function show(Request $request, $id)
    {
        $sort_search = null;
        $language = Language::findOrFail($id);
        $lang_keys = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'));
        if ($request->has('search')){
            $sort_search = $request->search;
            $lang_keys = $lang_keys->where('lang_key', 'like', '%'.$sort_search.'%');
        }
        $lang_keys = $lang_keys->get();
        return view('admin.setup-configuration.language.show', compact('language', 'lang_keys'));
    }

    public function delete($id)
    {
        $language = Language::find($id);
        $language->delete();
        return redirect()->back()->with('Language delete Successfully');
    }

    public function key_value_store(Request $request)
    {
        $language = Language::findOrFail($request->id);
        foreach ($request->values as $key => $value) {
            $translation_def = Translation::where('lang_key', $key)->where('lang', $language->code)->latest()->first();
            if($translation_def == null){
                $translation_def = new Translation;
                $translation_def->lang = $language->code;
                $translation_def->lang_key = $key;
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
            else {
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
        }
        Cache::forget('translations-'.$language->code);
        return back()->with('success', translate('Translations updated for :language', ['language' => $language->name]));

    }

    public function updateRTL(Request $request)
    {
        $language = Language::find($request->language_id);
        if ($language)
        {
            $language->rtl = $request->rtl;
            $language->save();
            return response()->json(['success' => 'Language rtl updated successfully.']);
        }
        else
        {
            return response()->json(['error' => 'Language not found.'], 404);
        }
    }
}
