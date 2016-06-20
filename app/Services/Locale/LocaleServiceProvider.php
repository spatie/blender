<?php

namespace App\Services\Locale;

use Illuminate\Translation\TranslationServiceProvider;

class LocaleServiceProvider extends TranslationServiceProvider
{
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new TranslationLoader($app['files'], $app['path.lang']);
        });
    }
}
