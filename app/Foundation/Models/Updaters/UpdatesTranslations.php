<?php

namespace App\Foundation\Models\Updaters;

trait UpdatesTranslations
{
    protected function updateTranslations()
    {
        foreach (config('app.locales') as $locale) {
            foreach ($this->model->translatedAttributes as $fieldName) {
                $translatedFieldName = translate_field_name($fieldName, $locale);

                if (!$this->request->has($translatedFieldName)) {
                    continue;
                }

                $this->model->translate($locale)->$fieldName = $this->request->get($translatedFieldName);
            }
        }
    }
}
