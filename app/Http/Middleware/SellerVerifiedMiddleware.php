<?php

namespace App\Http\Middleware;

use App\Models\Seller;
use Closure;
use Illuminate\Http\Request;
use Session;

class SellerVerifiedMiddleware
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
        if ($seller->is_verified == 2)
        {
            return redirect()->route('seller.verify')->with('error', 'Please verify first');
        }
        else
        {
            return $next($request);
        }
    }
}
