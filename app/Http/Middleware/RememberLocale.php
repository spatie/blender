<?php

namespace App\Http\Middleware;

use Closure;

class RememberLocale
{
    public function handle($request, Closure $next)
    {
        return $next($request)->withCookie('locale', app()->getLocale(), 60 * 24 * 365 * 5);
    }
}
