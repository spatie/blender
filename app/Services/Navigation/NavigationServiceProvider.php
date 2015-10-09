<?php

namespace App\Services\Navigation;

use Illuminate\Support\ServiceProvider;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->make(Breadcrumbs::class)->register();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('navigation', Navigation::class);
    }
}
