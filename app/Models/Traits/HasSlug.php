<?php

namespace App\Models\Traits;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function ($model) {
            $model->attributes['slug'] = $model->generateSlug();
        });
    }

    protected function generateSlug(): string
    {
        $slugs = [];

        foreach ($this->getTranslatedLocales('name') as $locale) {
            $slugs[$locale] = str_slug($this->getTranslation('name', $locale));
        }

        return json_encode($slugs);
    }
}
