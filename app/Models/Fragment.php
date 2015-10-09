<?php

namespace App\Models;

use App\Models\Foundation\Base\TranslatableEloquent;
use App\Models\Foundation\Traits\Presentable;

class Fragment extends TranslatableEloquent
{
    use Presentable;

    protected $guarded = ['id'];
    public $translatedAttributes = ['text'];

    public function updateWithRelations(array $attributes)
    {
        foreach (config('app.locales') as $locale) {
            $this->translate($locale)->text = $attributes[translate_field_name('text', $locale)];
        }

        return $this;
    }

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
