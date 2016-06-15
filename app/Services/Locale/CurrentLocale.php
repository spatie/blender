<?php

namespace App\Services\Locale;

class CurrentLocale
{
    public static function determine(): string
    {
        if (request()->isBack()) {
            return config('app.backLocales')[0];
        }

        return static::isValidLocale(app()->request->segment(1)) ? 
            app()->request->segment(1) : app()->getLocale();
    }

    public static function getContentLocale(): string
    {
        if (!static::isValidLocale(locale())) {
            return config('app.locales')[0];
        }

        return locale();
    }

    protected static function isValidLocale($locale): bool
    {
        if (!is_string($locale)) {
            return false;
        }

        $locales = config('app.locales');

        return in_array($locale, $locales);
    }

    protected static function isValidBackLocale(string $locale): bool
    {
        $backLocales = config('app.backLocales');

        return in_array($locale, $backLocales);
    }
}
