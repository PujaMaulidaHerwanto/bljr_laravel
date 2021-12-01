<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->guest() || !auth()->user()->is_admin) {
            abort(403);
        }
        // if (auth()->guest() || auth()->user()->username !== 'renjunhuang') {
        //     abort(403);
        // }

        // setelah ini jangn lupa daftarin middleware nya di kernel, biar bisa

        return $next($request);
    }
}
