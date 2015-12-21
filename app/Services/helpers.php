<?php

/**
 * Get the app's current locale.
 *
 * @return string
 */
function locale()
{
    return app()->getLocale();
}

/**
 * Get the app's current content locale.
 *
 * @return string
 */
function content_locale()
{
    return app('currentLocale')->getContentLocale();
}

/**
 * Get a translated fragment's text. Since this utility function is occasionally used in route files, there's also a
 * check for the database connection to return a fallback fragment in local environments.
 *
 * @param string $name
 * @param string $locale
 *
 * @return \Spatie\String\Str
 */
function fragment($name, $locale = null)
{
    $locale = $locale ?: content_locale();

    $fragment = app(App\Repositories\FragmentRepository::class)->findByName($name);

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

/**
 * @param string $fieldName
 * @param string $locale
 *
 * @return string
 */
function translate_field_name($fieldName, $locale)
{
    return  'translated_'.$locale.'_'.$fieldName;
}

/**
 * @param string $technicalName
 *
 * @return \App\Models\Article
 */
function article($technicalName)
{
    $article = app(App\Repositories\ArticleRepository::class)->findByTechnicalName($technicalName);
    
    if (is_null($article)) {
        throw new Exception("Article `{$technicalName}` doesn't exist.");
    }
    
    return $article;
}

/**
 * Create a carbon instance from a string.
 *
 * @param string $date
 * @param string $format
 *
 * @return \Carbon\Carbon
 */
function carbon($date, $format = 'Y-m-d H:i:s')
{
    return Carbon\Carbon::createFromFormat($format, $date);
}

/**
 * Get a human readable the difference to now.
 *
 * @param \Carbon\Carbon $date
 *
 * @return string
 */
function diff_date_for_humans(Carbon\Carbon $date)
{
    return (new Jenssegers\Date\Date($date->timestamp))->ago();
}

/**
 * Get a Roman formatted year.
 *
 * @param string
 *
 * @return string
 */
function roman_year($year = '')
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

/**
 * Get a the short class name of an object.
 *
 * @param mixed object
 *
 * @return string
 */
function short_class_name($object)
{
    $objectProperties = new \ReflectionClass($object);

    return $objectProperties->getShortName();
}

/**
 * Get all constants of a class.
 *
 * @param mixed  $object
 * @param string $startsWithFilter
 *
 * @return array
 */
function class_constants($object, $startsWithFilter = '')
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
 *
 * @return bool
 */
function validate($fields, $rules)
{
    if (!is_array($fields)) {
        $fields = ['default' => $fields];
    }

    if (!is_array($rules)) {
        $rules = ['default' => $rules];
    }

    return Validator::make($fields, $rules)->passes();
}
