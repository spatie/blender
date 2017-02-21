<?php

namespace App\Services\Html;

use Carbon\Carbon;
use Spatie\Html\Elements\Fieldset;
use Spatie\Translatable\HasTranslations;

class Html extends \Spatie\Html\Html
{
    use Concerns\Alerts;
    use Concerns\Forms;
    use Concerns\Inline;

    /** @var string */
    protected $locale = null;

    /**
     * @param string $locale
     *
     * @return static
     */
    public function locale(string $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return static
     */
    public function endLocale()
    {
        $this->locale = null;

        return $this;
    }

    public function translations(callable $callback)
    {
        $fieldsets = locales()->map(function ($locale) use ($callback) {
            $this->locale($locale);

            return $this->translatedFieldset($locale, $callback());
        });

        $this->endLocale();

        return $this->div()->addChildren($fieldsets);
    }

    public function translatedFieldset(string $locale, $contents): Fieldset
    {
        return $this
            ->fieldset()
            ->addChild($this->legend($locale)->class('legend__lang'))
            ->addChildren($contents);
    }

    public function formGroup(): FormGroup
    {
        return new FormGroup($this);
    }

    protected function old(string $name, ?string $value = '')
    {
        if (empty($name)) {
            return;
        }

        if (empty($value) && $this->model) {
            $value = $this->locale && is_object($this->model) && in_array(HasTranslations::class, class_uses_recursive($this->model)) ?
                $this->model->getTranslation($name, $this->locale) ?? '' :
                $this->model[$name] ?? '';
        }

        if ($value instanceof Carbon) {
            return $value->format('d/m/Y');
        }

        if (! is_string($value)) {
            $value = '';
        }

        return $this->request->old($this->fieldName($name), $value);
    }

    protected function fieldName(string $name): string
    {
        if ($this->locale) {
            return translate_field_name($name, $this->locale);
        }

        return $name;
    }
}
