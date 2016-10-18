<?php

namespace App\Http\Controllers\Back\Updaters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

trait UpdateTranslations
{
    protected function updateTranslations(Model $model, FormRequest $request)
    {
        foreach (config('app.locales') as $locale) {
            foreach ($model->getTranslatableAttributes() as $fieldName) {
                $translatedFieldName = translate_field_name($fieldName, $locale);

                if (! $request->has($translatedFieldName)) {
                    continue;
                }

                $model->setTranslation($fieldName, $locale, $request->get($translatedFieldName));
            }
        }
    }
}
