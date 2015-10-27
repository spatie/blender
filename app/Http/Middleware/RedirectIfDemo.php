<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

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
    public function handle($request, Closure $next)
    {
        if ($this->protectedByDemoMode($request) ) {

            if ($this->isGrantAccessToDemoRequest($request)) {
                $this->grantAccessToDemo();
                return new RedirectResponse('/');
            }

            if (! $this->hasDemoAccess($request)) {
                return response()->view('temp.index');
            }
        }

        return $next($request);
    }

    /**
     * Determine if this site is protected by demo mode.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function protectedByDemoMode($request)
    {
        return config('app.demo');
    }

    /**
     * Determine if this route grants access to the demo.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function isGrantAccessToDemoRequest($request)
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
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function hasDemoAccess($request)
    {
        if (session()->has('demo_access_granted')) return true;

        if (auth()->user()) return true;

        if (starts_with('/auth', $request->getRequestUri())) return true;

        return false;
    }

}
