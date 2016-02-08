<?php

namespace App\Services\Locale;

use Illuminate\Support\ServiceProvider;

class LocaleServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->singleton(CurrentLocale::class);
        $this->app->alias(CurrentLocale::class, 'currentLocale');
    }
}
