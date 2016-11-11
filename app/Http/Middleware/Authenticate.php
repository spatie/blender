<?php

namespace App\Http\Middleware;

use App\Services\Auth\Back\User;
use Closure;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (app()->environment() === 'production') {
            die('Remove Auth::login(User::first() from Authenticate middleware');
        }
        \Auth::login(User::first());

        if (! current_user()) {
            return $this->handleUnauthorizedRequest($request);
        }

        current_user()->registerLastActivity()->save();

        return $next($request);
    }

    protected function handleUnauthorizedRequest($request)
    {
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        }

        return redirect()->guest(login_url());
    }
}
