<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    protected $except = [
        '/blender/api/media',
        '/newsletter/api/subscribe',
    ];

    public function handle($request, Closure $next)
    {
        return $this->addCookieToResponse($request, $next($request));
    }
}
