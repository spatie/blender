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
 * check for the database connection to return a fallback article in local environments.
 *
 * @param string $name
 * @param string $locale
 *
 * @return string
 */
function fragment($name, $locale = null)
{
    $locale = $locale ?: content_locale();

    $fragment = app(App\Repositories\FragmentRepository::class)->findByName($name);

    if (!$fragment) {
        return $name;
    }

    return $fragment->getTranslation($locale)->text;
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
 * Find an article by it's technical name. Since this utility function is occasionally used in route files, there's
 * also a check for the database connection to return a fallback article in local environments.
 *
 * @param string $technicalName
 *
 * @return \App\Models\Article
 */
function article($technicalName)
{
    return app(App\Repositories\ArticleRepository::class)->findByTechnicalName($technicalName);
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
