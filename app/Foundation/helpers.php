<?php
/**
 * Get the app's current locale.
 */
function locale() : string
{
    return app()->getLocale();
}

/**
 * Get the app's current content locale.
 */
function content_locale() : string
{
    return app('currentLocale')->getContentLocale();
}

function fragment($name, array $replacements = []) : string
{
    $fragment = App\Models\Fragment::findByName($name);

    if (!$fragment) {
        return $name;
    }

    $text = $fragment->text;

    foreach ($replacements as $key => $value) {
        $text = str_replace(
            [':'.Str::upper($key), ':'.Str::ucfirst($key), ':'.$key],
            [Str::upper($value), Str::ucfirst($value), $value],
            $text
        );
    }

    return $text;
}

function fragment_slug($name, array $replacements = []) : string
{
    $translation = fragment($name, $replacements);

    return str_slug($translation);
}

function translate_field_name(string $fieldName, string $locale) : string
{
    return  'translated_'.$locale.'_'.$fieldName;
}


function article(string $technicalName) : App\Models\Article
{
    return App\Models\Article::findByTechnicalName($technicalName);
}


function carbon(string $date, string $format = 'Y-m-d H:i:s') : Carbon\Carbon
{
    return Carbon\Carbon::createFromFormat($format, $date);
}

function diff_date_for_humans(Carbon\Carbon $date) : string
{
    return (new Jenssegers\Date\Date($date->timestamp))->ago();
}


function roman_year(int $year = null) : string
{
    if (!is_numeric($year)) {
        $year = date('Y');
    }

    $result = '';

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


function short_class_name($object) : string
{
    $objectProperties = new \ReflectionClass($object);

    return $objectProperties->getShortName();
}


function class_constants($object, string  $startsWithFilter = '') : array
{
    $objectProperties = new \ReflectionClass($object);

    $constants = $objectProperties->getConstants();

    if ($startsWithFilter == '') {
        return $constants;
    }

    return array_filter($constants, function ($key) use ($startsWithFilter) {
        return starts_with(strtolower($key), strtolower($startsWithFilter));
    }, ARRAY_FILTER_USE_KEY);
}

/**
 * Translate the given message.
 *
 * @param string $id
 * @param array  $parameters
 * @param string $locale
 *
 * @return string
 */
function translate($id = null, $parameters = [], $locale = null)
{
    return trans($id, $parameters, $domain = 'messages');
}

/** @return \App\Services\Auth\Front\User|\App\Services\Auth\Back\User|null */
function current_user()
{
    return app(App\Services\Navigation\Section::class)->isFront() ?
        current_front_user() :
        current_back_user();
}

/** @return \App\Services\Auth\Front\User|null */
function current_front_user()
{
    if (! auth()->guard('front')->check()) {
        return null;
    }

    return auth()->guard('front')->user();
}

/** @return \App\Services\Auth\Back\User|null */
function current_back_user()
{
    if (! auth()->guard('back')->check()) {
        return null;
    }

    return auth()->guard('back')->user();
}

function login_url() : string
{
    return app(App\Services\Navigation\Section::class)->isFront() ?
        action('Front\AuthController@getLogin') :
        action('Back\AuthController@getLogin');
}

function logout_url() : string
{
    return app(App\Services\Navigation\Section::class)->isFront() ?
        action('Front\AuthController@getLogout') :
        action('Back\AuthController@getLogout');
}

function register_url() : string
{
    return action('Front\AuthController@getRegister');
}

/**
 * Validate some data.
 *
 * @param string|array $fields
 * @param string|array $rules
 *
 * @return bool
 */
function validate($fields, $rules) : bool
{
    if (!is_array($fields)) {
        $fields = ['default' => $fields];
    }

    if (!is_array($rules)) {
        $rules = ['default' => $rules];
    }

    return Validator::make($fields, $rules)->passes();
}

function lang_to_fragments(string $namespace, array $names, array $defaults = []) : array
{
    return array_reduce($names, function ($carry, $name) use ($namespace) {
        $carry[$name] = fragment("{$namespace}.{$name}");

        return $carry;
    }, $defaults);
}

function activity(string $message)
{
    Activity::log($message);
}
