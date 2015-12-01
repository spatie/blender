<?php

namespace App\Models;

use App\Models\Foundation\Base\TranslatableEloquent;
use App\Models\Foundation\Traits\Presentable;

class Fragment extends TranslatableEloquent
{
    use Presentable;

    protected $guarded = ['id'];

    public $translatedAttributes = ['text'];

    /**
     * Return a sluggified version the text of the string.
     *
     * @param $name
     * @param string $locale
     *
     * @return string
     */
    public static function getSlugAttribute($name, $locale = '')
    {
        return str_slug(static::getText($name, $locale));
    }
}
