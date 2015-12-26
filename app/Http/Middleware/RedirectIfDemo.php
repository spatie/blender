<?php

namespace App\Http\Middleware;

use App\Services\Navigation\CurrentSection;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectIfDemo
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->protectedByDemoMode()) {
            if ($this->isGrantAccessToDemoRequest($request)) {
                $this->grantAccessToDemo();

                return new RedirectResponse('/');
            }

            if (!$this->hasDemoAccess()) {
                return response()->view('temp.index');
            }
        }

        return $next($request);
    }

    /**
     * Determine if this site is protected by demo mode.
     *
     * @return bool
     */
    protected function protectedByDemoMode()
    {
        if (! app(CurrentSection::class)->isFront()) {
            return false;
        }

        return config('app.demo');
    }

    /**
     * Determine if this route grants access to the demo.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function isGrantAccessToDemoRequest(Request $request)
    {
        return $request->getRequestUri() === '/demo';
    }

    /**
     * Grant access to demo.
     */
    protected function grantAccessToDemo()
    {
        session()->put('demo_access_granted', true);
    }

    /**
     * Determine if the user has demo access.
     *
     * @return bool
     */
    protected function hasDemoAccess()
    {
        if (session()->has('demo_access_granted')) {
            return true;
        }

        if (auth()->user()) {
            return true;
        }

        return false;
    }
}
