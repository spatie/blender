<?php

namespace App\Http\Controllers\Back\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait UpdateTranslations
{
    protected function updateTranslations(Model $model, Request $request)
    {
        foreach (config('app.locales') as $locale) {
            foreach ($model->getTranslatableAttributes() as $fieldName) {
                $translatedFieldName = translate_field_name($fieldName, $locale);

                if (! $request->exists($translatedFieldName)) {
                    continue;
                }

                $model->setTranslation($fieldName, $locale, $request->get($translatedFieldName));
            }
        }
    }
}
