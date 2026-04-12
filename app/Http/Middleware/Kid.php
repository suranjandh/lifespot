<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Kid
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
        if (Auth::check() && Auth::user()->user_access == 1) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->user_access == 0) {
            return redirect('/estate');
        } else {
            return redirect('/logout');
        }
    }
}
