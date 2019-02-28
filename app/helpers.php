<?php

use Carbon\Carbon;
use App\Models\Article;
use App\Models\Fragment;
use App\Models\Recipient;
use App\Services\Seo\Meta;
use App\Services\Auth\User;
use App\Services\Html\Html;
use Illuminate\Support\Str;
use App\Services\Seo\Schema;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Validator;

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
function current_user(): ?User
{
    if (request()->isFront()) {
        return auth()->guard('front')->user();
    }

    if (request()->isBack()) {
        return auth()->guard('back')->user();
    }

    throw new Exception('Coud not determine current user');
}

function diff_date_for_humans(Carbon $date) : string
{
    return (new Jenssegers\Date\Date($date->timestamp))->ago();
}

function fragment_image($name, $conversion = 'thumb'): string
{
    if (! Str::contains($name, '.')) {
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

function meta(): Meta
{
    return app(Meta::class);
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

function schema(): Schema
{
    return new Schema();
}

function recipients(string $formName): array
{
    return Recipient::forForm($formName);
}

/**
 * Shortens a string in a pretty way. It will clean it by trimming
 * it, remove all double spaces and html. If the string is then still
 * longer than the specified $length it will be shortened. The end
 * of the string is always a full word concatenated with the
 * specified moreTextIndicator.
 *
 * @param string $string
 * @param int    $length
 * @param string $moreTextIndicator
 *
 * @return string
 */
function str_tease(string $string, int $length = 200, string $moreTextIndicator = '...'): string
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

function svg($filename): HtmlString
{
    return new HtmlString(
        file_get_contents(resource_path("assets/svg/{$filename}.svg"))
    );
}

function translate_field_name($name, $locale = ''): string
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

function class_has_trait($className, string $traitName): bool
{
    if (is_object($className)) {
        $className = get_class($className);
    }

    return in_array($traitName, class_uses_recursive($className));
}
