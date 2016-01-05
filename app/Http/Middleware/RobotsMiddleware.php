<?php

namespace App\Http\Middleware;

use App\Services\Navigation\CurrentSection;
use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware as BaseRobotsMiddleware;

class RobotsMiddleware extends BaseRobotsMiddleware
{
    protected function shouldIndex(Request $request) : bool
    {
        if (! app()->environment('production')) {
            return false;
        }

        if (! env('ALLOW_ROBOTS')) {
            return false;
        }

        return app(CurrentSection::class)->isFront();
    }
}
