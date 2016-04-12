<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware as BaseRobotsMiddleware;

class RobotsMiddleware extends BaseRobotsMiddleware
{
    protected function shouldIndex(Request $request) : bool
    {
        if (ends_with($request->getHost(), 'spatie.be')) {
            return false;
        }

        if (! app()->environment('production')) {
            return false;
        }

        if (! env('ALLOW_ROBOTS')) {
            return false;
        }

        return request()->isFront();
    }

    protected function responseWithRobots(string $contents)
    {
        $this->response->headers->set('x-robots-tag', "{$contents}, noodp", false);
        return $this->response;
    }
}
