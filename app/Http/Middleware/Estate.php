<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Estate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_access == 0) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->user_access == 1) {
            return redirect('/kid');
        } else {
            return redirect('/logout');
        }
    }
}
