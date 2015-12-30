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

/**
 * Get a translated fragment's text. Since this utility function is occasionally used in route files, there's also a
 * check for the database connection to return a fallback fragment in local environments.
 *
 * @param string $locale
 *
 * @return \Spatie\String\Str | string
 */
function fragment(string $name,$locale = null)
{
    $locale = $locale ?: content_locale();

    $fragment = App\Models\Fragment::findByName($name);

    if (!$fragment) {
        return $name;
    }

    return string($fragment->getTranslation($locale)->text);
}

/**
 * Get a translated fragment slug.
 *
 * @param string $name
 * @param string $locale
 *
 * @return string
 */
function fragment_slug($name, $locale = null)
{
    $translation = fragment($name, $locale);

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

/**
 * Return the currentUser.
 *
 * @return bool|\App\Models\User
 */
function currentUser()
{
    if (!auth()->check()) {
        return false;
    }

    return auth()->user();
}

/**
 * Validate some data.
 *
 * @param string|array $fields
 * @param string|array $rules
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
