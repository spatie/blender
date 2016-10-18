<?php

use Illuminate\Support\Collection;

function article(string $technicalName): App\Models\Article
{
    return App\Models\Article::findByTechnicalName($technicalName);
}

function content_locale(): string
{
    return \App\Services\Locale\CurrentLocale::getContentLocale();
}

/**
 * @return \App\Services\Auth\Back\User|\App\Services\Auth\Front\User|null
 *
 * @throws \Exception
 */
function current_user()
{
    if (request()->isFront()) {
        return current_front_user();
    }

    if (request()->isBack()) {
        return current_back_user();
    }

    throw new \Exception('Coud not determine current user');
}

/**
 * @return \App\Services\Auth\Front\User|null
 */
function current_front_user()
{
    if (! auth()->guard('front')->check()) {
        return;
    }

    return auth()->guard('front')->user();
}

/**
 * @return \App\Services\Auth\Back\User|null
 */
function current_back_user()
{
    if (! auth()->guard('back')->check()) {
        return;
    }

    return auth()->guard('back')->user();
}

function diff_date_for_humans(Carbon\Carbon $date): string
{
    return (new Jenssegers\Date\Date($date->timestamp))->ago();
}

function el(string $tag, $attributes = null, $contents = null): string
{
    return \Spatie\HtmlElement\HtmlElement::render($tag, $attributes, $contents);
}

function fragment($name, array $replacements = []): string
{
    return trans($name, $replacements);
}

function fragment_slug($name, array $replacements = []): string
{
    $translation = fragment($name, $replacements);

    return str_slug($translation);
}

function locale(): string
{
    return app()->getLocale();
}

function locales(): Collection
{
    return collect(config('app.locales'));
}

function login_url(): string
{
    return request()->isFront() ?
        action('Front\Auth\LoginController@showLoginForm') :
        action('Back\Auth\LoginController@showLoginForm');
}

function logout_url(): string
{
    return request()->isFront() ?
        action('Front\Auth\LoginController@logout') :
        action('Back\Auth\LoginController@logout');
}

function roman_year(int $year = null): string
{
    $year = $year ?? date('Y');

    $romanNumerals = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    $result = '';

    foreach ($romanNumerals as $roman => $yearNumber) {
        // Divide to get  matches
        $matches = intval($year / $yearNumber);

        // Assign the roman char * $matches
        $result .= str_repeat($roman, $matches);

        // Substract from the number
        $year = $year % $yearNumber;
    }

    return $result;
}

function register_url(): string
{
    return action('Front\Auth\RegisterController@showRegistrationForm');
}

function translate_field_name(string $name, string $locale = ''): string
{
    $locale = $locale ?? content_locale();

    return "translated_{$locale}_{$name}";
}

/**
 * Validate some data.
 *
 * @param string|array $fields
 * @param string|array $rules
 *
 * @return bool
 */
function validate($fields, $rules): bool
{
    if (! is_array($fields)) {
        $fields = ['default' => $fields];
    }

    if (! is_array($rules)) {
        $rules = ['default' => $rules];
    }

    return Validator::make($fields, $rules)->passes();
}
