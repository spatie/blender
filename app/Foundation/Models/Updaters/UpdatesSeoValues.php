<?php

namespace App\Foundation\Models\Updaters;

use Illuminate\Support\Collection;
use Spatie\Regex\MatchResult;
use Spatie\Regex\Regex;

trait UpdatesSeoValues
{
    protected function updateMetaTags()
    {
        collect($this->request->all())
            ->filter(function ($value, $fieldName) {
                // Filter out everything that starts with 'translated_<locale>_seo_'
                return Regex::match('/^translated_([a-z][a-z])_seo_/', $fieldName)->hasMatch();
            })
            ->map(function ($value, $fieldName) {

                // Replace 'translated_<locale>_seo_<attribute>' with '<locale>_<attribute>'
                $localeAndAttribute = Regex::replace('/translated_([a-z][a-z])_seo_/', function (MatchResult $matchResult) {
                    return $matchResult->group(1) . '_';
                }, $fieldName)->result();

                $localeAndAttribute = explode('_', $localeAndAttribute, 2);

                return [
                    'locale' => $localeAndAttribute[0],
                    'attribute' => $localeAndAttribute[1],
                    'value' => $value,
                ];
            })
            ->groupBy('locale')
            ->map(function (Collection $valuesInLocale) {
                return $valuesInLocale->mapToAssoc(function ($values) {
                    return [$values['attribute'], $values['value']];
                });
            })
            ->each(function ($values, $locale) {
                $this->model->setTranslation('seo_values', $locale, $values);
            });
    }
}
