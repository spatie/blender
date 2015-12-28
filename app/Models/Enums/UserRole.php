<?php

namespace App\Models\Enums;

use MyCLabs\Enum\Enum;

class UserRole extends Enum
{
    const ADMIN = 'admin';
    const MEMBER = 'member';

    public static function allAsRegex() : string
    {
        return collect(self::values())->map(function ($role) {
            return "({$role})";
        })->implode('|');
    }
}
