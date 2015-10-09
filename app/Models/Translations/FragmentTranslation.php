<?php

namespace App\Models\Translations;

use App\Models\Foundation\Base\Translation;
use App\Models\Fragment;
use Cache;

class FragmentTranslation extends Translation
{
    public static function boot()
    {
        parent::boot();

        static::updating(function ($stringTranslation) {
            $string = Fragment::findOrFail($stringTranslation->string_id);
            Cache::forget(Fragment::getCacheKeyName($string->name, $stringTranslation->locale));
        });
    }
}
