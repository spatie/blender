<?php

namespace App\Services\Locale;

use Exception;
use Illuminate\Contracts\Encryption\Encrypter;

class CurrentLocale
{
    public static function determine(): string
    {
        if (request()->isBack()) {
            return 'en';
        }

        $urlLocale = app()->request->segment(1);

        if (static::isValidLocale($urlLocale)) {
            return $urlLocale;
        }

        try {
            $cookieLocale = app(Encrypter::class)->decrypt(request()->cookie('locale'));

            if (self::isValidLocale($cookieLocale)) {
                return $cookieLocale;
            }
        } catch (Exception $exception) {
        }

        $browserLocale = collect(request()->getLanguages())->first();

        if (self::isValidLocale($browserLocale)) {
            return $browserLocale;
        }

        return app()->getLocale();
    }

    public static function getContentLocale(): string
    {
        if (! static::isValidLocale(locale())) {
            return config('app.locales')[0];
        }

        return locale();
    }

    public static function isValidLocale($locale): bool
    {
        if (! is_string($locale)) {
            return false;
        }

        $locales = config('app.locales');

        return in_array($locale, $locales);
    }
}
