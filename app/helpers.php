<?php

use App\Models\Article;
use App\Models\Fragment;
use App\Services\Auth\User;
use App\Services\Html\Html;
use App\Services\Seo\Meta;
use App\Services\Seo\Schema;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Spatie\HtmlElement\HtmlElement;

function article(string $specialArticle): Article
{
    return App\Repositories\ArticleRepository::findSpecialArticle($specialArticle);
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
function current_user(): ? User
{
    if (request()->isFront()) {
        return auth()->guard('front')->user();
    }

    if (request()->isBack()) {
        return auth()->guard('back')->user();
    }

    throw new \Exception('Coud not determine current user');
}

function diff_date_for_humans(Carbon $date) : string
{
    return (new Jenssegers\Date\Date($date->timestamp))->ago();
}

function el(string $tag, $attributes = null, $contents = null)
{
    return new HtmlString(HtmlElement::render($tag, $attributes, $contents));
}

function fragment_image($name, $conversion = 'thumb'): string
{
    if (! str_contains($name, '.')) {
        return $name;
    }

    [$group, $key] = explode('.', $name, 2);

    $fragment = Fragment::with('media')
        ->where('group', $group)
        ->where('key', $key)
        ->first();

    if (! $fragment) {
        return $name;
    }

    return $fragment->getFirstMediaUrl('images', $conversion);
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

function carbon(string $date = null, string $format = null): Carbon
{
    if (func_num_args() === 0) {
        return Carbon::now();
    }

    if (is_null($date)) {
        throw new InvalidArgumentException("Date can't be null");
    }

    if (is_null($format)) {
        return Carbon::parse($date);
    }

    return Carbon::createFromFormat($format, $date);
}

function register_url(): string
{
    return action('Front\Auth\RegisterController@showRegistrationForm');
}

function translate_field_name($name, $locale = '')
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

function schema(): Schema
{
    return new Schema();
}

/**
 * Shortens a string in a pretty way. It will clean it by trimming
 * it, remove all double spaces and html. If the string is then still
 * longer than the specified $length it will be shortened. The end
 * of the string is always a full word concatinated with the
 * specified moreTextIndicator.
 *
 * @param string $string
 * @param int    $length
 * @param string $moreTextIndicator
 *
 * @return string
 */
function str_tease(string $string, $length = 200, $moreTextIndicator = '...')
{
    $string = trim($string);

    //remove html
    $string = strip_tags($string);

    //replace multiple spaces
    $string = preg_replace("/\s+/", ' ', $string);

    if (strlen($string) == 0) {
        return '';
    }

    if (strlen($string) <= $length) {
        return $string;
    }

    $ww = wordwrap($string, $length, "\n");

    $string = substr($ww, 0, strpos($ww, "\n")).$moreTextIndicator;

    return $string;
}

function fragment($id = null, $replace = [], $locale = null)
{
    return trans($id, $replace, $locale);
}

function meta(): Meta
{
    return app(Meta::class);
}
