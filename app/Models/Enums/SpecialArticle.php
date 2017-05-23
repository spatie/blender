<?php

namespace App\Models\Enums;

use ReflectionClass;

class SpecialArticle implements Enumerator
{
    const __default = self::HOME;
    const HOME = 'home';
    const CONTACT = 'contact';
    
     /**
     * @return array
     */
    public static function __toArray(): array
    {
        return (new ReflectionClass(get_class()))->getConstants();
    }
}
