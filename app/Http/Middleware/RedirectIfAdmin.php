<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            abort('401');
        }

        return $next($request);
    }
}
