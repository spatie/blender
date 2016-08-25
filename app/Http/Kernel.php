<?php

namespace App\Http;

use App\Http\Middleware\RememberLocale;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Spatie\Authorize\Middleware\Authorize;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\LoginAs::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \App\Http\Middleware\RobotsMiddleware::class,
        \App\Http\Middleware\SanitizeInput::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'demoMode' => \Spatie\DemoMode\DemoMode::class,
        'rememberLocale' => \App\Http\Middleware\RememberLocale::class,
    ];
}
