<?php

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
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1, ];

    foreach ($romanNumerals as $roman => $yearNumber) {
        /*** divide to get  matches ***/
        $matches = intval($year / $yearNumber);

        /*** assign the roman char * $matches ***/
        $result .= str_repeat($roman, $matches);

        /*** substract from the number ***/
        $year = $year % $yearNumber;
    }

    /*** return the res ***/
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
