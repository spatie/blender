<?php

namespace App\Services\Locale;

use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\Translator;

class LocaleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CurrentLocale::class);
        $this->app->alias(CurrentLocale::class, 'currentLocale');

        $this->registerLoader();

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            $locale = $app['config']['app.locale'];

            $trans = new Translator($loader, $locale);

            $trans->setFallback($app['config']['app.fallback_locale']);

            return $trans;
        });
    }

    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new TranslationLoader($app['files'], $app['path.lang']);
        });
    }

    public function provides(): array
    {
        return ['translator', 'translation.loader'];
    }
}
