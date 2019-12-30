<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Preparator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->primaryAdmin() or Auth::user()->preparator()) {
            return $next($request);

        }
        return redirect()->route('showOrders');

    }
}
