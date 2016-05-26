<?php

namespace App\Foundation\Models\Traits;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function ($model) {
            $model->attributes['url'] = $model->generateSlug();
        });
    }

    protected function generateSlug():string
    {
        $slugs = [];

        foreach ($this->getTranslatedLocales('name') as $locale) {
            $slugs[$locale] = str_slug($this->getTranslation('name', $locale));
        }

        return json_encode($slugs);
    }
}
