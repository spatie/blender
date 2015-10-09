<?php

namespace App\Http\Middleware;

use Closure;

class SanitizeInput
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
        $this->sanitizeInput($request);

        return $next($request);
    }

    /**
     * Sanitize the form input from a request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    protected function sanitizeInput($request)
    {
        $sanitized = [];

        if ($request->has('email')) {
            $email = $request->get('email');
            $sanitized['email'] = trim($email, ' ');
        }

        $request->merge($sanitized);
    }
}
