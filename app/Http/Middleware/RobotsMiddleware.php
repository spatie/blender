<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware as BaseRobotsMiddleware;

class RobotsMiddleware extends BaseRobotsMiddleware
{
    protected function shouldIndex(Request $request): bool
    {
        if (Str::endsWith($request->getHost(), 'spatie.be')) {
            return false;
        }

        if (! app()->environment('production')) {
            return false;
        }

        if (! config('app.allow_robots')) {
            return false;
        }

        return request()->isFront();
    }
}
