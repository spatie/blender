<?php

namespace App\Http\Middleware;

use Closure;

class RememberLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)->withCookie('locale', app()->getLocale(), 60 * 24 * 365 * 5);
    }
}
