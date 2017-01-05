<?php

namespace App\Providers;

use App\Services\Locale\CurrentLocale;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;

class LocaleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $locale = CurrentLocale::determine();

        $this->app->setLocale(CurrentLocale::determine());

        Date::setLocale($locale);
    }
}
