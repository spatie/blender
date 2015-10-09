<?php

namespace App\Services\Locale;

use Illuminate\Support\ServiceProvider;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(CurrentLocale::class);

        $this->app->alias(CurrentLocale::class, 'currentLocale');
    }
}
