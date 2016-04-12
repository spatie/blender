<?php

namespace App\Foundation\Models\Traits;

trait HasUrl
{
    public static function bootHasUrl()
    {
        static::saving(function ($model) {

            if (!in_array('name', $model->translatable ?? [])) {
                $model->url = str_slug($model->name);
                return;
            }

            foreach ($model->getTranslatedLocales('name') as $locale) {
                $model->setTranslation('url', $locale, str_slug($model->getTranslation('name', $locale)));
            }
        });
    }
}
