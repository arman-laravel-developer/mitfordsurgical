<?php

namespace App\Http\Middleware;

use App\Models\Seller;
use Closure;
use Illuminate\Http\Request;
use Session;

class SellerUnbannedMiddleware
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
        $seller = Seller::find(Session::get('seller_id'));
        if ($seller->status != 1)
        {
            Session::forget('seller_id');
            Session::forget('seller_name');
            return redirect()->route('home')->with('error', 'Your account is banned. Please contact admin.');
        }
        else
        {
            return $next($request);
        }
    }
}
