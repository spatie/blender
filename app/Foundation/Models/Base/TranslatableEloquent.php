<?php

namespace App\Foundation\Models\Base;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

abstract class TranslatableEloquent extends Model
{
    use Translatable;

    protected $guarded = ['id'];
    protected $with = ['translations'];

    public function getTranslationModelNameDefault()
    {
        if (isset($this->translationModel)) {
            return $this->translationModel;
        }

        $classParts = explode('\\', get_class($this));
        $class = array_pop($classParts);

        return "App\\Models\\Translations\\{$class}Translation";
    }

    /**
     * Get the translation for the given locale. If it doesn't exist create it.
     *
     * @param null $locale
     * @param bool $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function translate($locale = null, $withFallback = false)
    {
        if ($this->hasTranslation($locale)) {
            return $this->getTranslation($locale, $withFallback);
        }

        return $this->getTranslationOrNew(is_null($locale) ? locale() : $locale);
    }
}
