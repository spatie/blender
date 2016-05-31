<?php

namespace App\Foundation\Models\Enums;

use Illuminate\Support\Collection;
use MyCLabs\Enum\Enum as BaseEnum;

abstract class Enum extends BaseEnum
{
    public function equals(Enum $enum): bool
    {
        if (!$enum instanceof $this) {
            throw new EnumTypesDontMatch();
        }

        return $this->getValue() === $enum->getValue();
    }

    public function doesntEqual(Enum $enum): bool
    {
        return !$this->equals($enum);
    }

    public static function toCollection():  Collection
    {
        return collect(static::toArray());
    }

    public static function allAsRegex(): string
    {
        return collect(static::values())->map(function ($value) {
            return "({$value})";
        })->implode('|');
    }
}
