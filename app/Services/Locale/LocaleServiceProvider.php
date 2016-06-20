<?php

namespace App\Services\Locale;

use Illuminate\Translation\TranslationServiceProvider;

class LocaleServiceProvider extends TranslationServiceProvider
{
    public function register()
    {
        $this->app->singleton(CurrentLocale::class);
        $this->app->alias(CurrentLocale::class, 'currentLocale');

        parent::register();
    }

    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new TranslationLoader($app['files'], $app['path.lang']);
        });
    }
}
