<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;
use Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check header request and determine localizaton
        if($request->hasHeader('App-Language')){
            $locale = $request->header('App-Language');
        }
        elseif(Session::get('locale'))
        {
            $locale = Session::get('locale');
        }
        elseif(env('DEFAULT_LANGUAGE') != null){
            $locale = env('DEFAULT_LANGUAGE');
        }
        else
        {
            $locale = config('app.fallback_locale');
        }


        // set laravel localization
        App::setLocale($locale);

        // continue request
        return $next($request);
    }
}
