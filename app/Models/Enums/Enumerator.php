<?php

namespace App\Models\Enums;

/**
 * Interface Enumerator
 *
 * @package App\Models\Enums;
 */
interface Enumerator
{
    /**
     * @return array
     */
    public static function __toArray(): array;
}
