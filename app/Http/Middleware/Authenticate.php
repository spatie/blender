<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

class Authenticate
{
    public function handle($request, Closure $next, string $guard)
    {
        if (auth()->guard($guard)->guest()) {
            return $this->handleUnauthorizedRequest($request, $guard);
        }

        current_user()->registerLastActivity();

        return $next($request);
    }

    protected function handleUnauthorizedRequest($request, string $guard)
    {
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        }

        if ($guard === 'front') {
            return redirect()->guest(action('Front\AuthController@getLogin'));
        }

        if ($guard === 'back') {
            return redirect()->guest(action('Back\AuthController@getLogin'));
        }

        throw new Exception('Invalid auth guard specified');
    }
}
