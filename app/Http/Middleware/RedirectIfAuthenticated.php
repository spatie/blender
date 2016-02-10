<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            return redirect()->to(current_user()->getHomeUrl());
        }

        return $next($request);
    }
}
