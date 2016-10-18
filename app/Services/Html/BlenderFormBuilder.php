<?php

namespace App\Services\Html;

use Form;
use Html;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;

class BlenderFormBuilder
{
    /** @var string */
    protected $module;

    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;

    /** @var \Illuminate\Support\ViewErrorBag */
    protected $errors;

    public function init(string $module, Model $model, ViewErrorBag $errors)
    {
        $this->module = $module;
        $this->model = $model;
        $this->errors = $errors;
    }

    public function label(string $name, bool $required = false, array $options = []): string
    {
        return Form::label($name, fragment("back.{$this->module}.{$name}").($required ? '*' : ''), $options);
    }

    public function error(string $name): string
    {
        return Html::error($this->errors->first($name));
    }

    public function text(string $name, bool $required = false, string $locale = ''): string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name, $required),
            Form::text($fieldName, Form::useInitialValue($this->model, $name, $locale)),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function textarea(string $name, bool $required = false, string $locale = ''): string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name, $required),
            Form::textarea($fieldName, Form::useInitialValue($this->model, $name, $locale), ['data-autosize']),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function redactor(string $name, bool $required = false, string $locale = ''): string
    {
        $fieldName = $this->fieldName($name, $locale);

        $options = [
            'data-editor' => '',
            'data-editor-medialibrary-url' => action(
                'Back\Api\MediaLibraryController@index',
                [
                    'model_name' => ucfirst(get_class($this->model)),
                    'model_id' => $this->model->id,
                    'redactor=true',
                ]
            ),
        ];

        return $this->group([
            $this->label($name, $required),
            Form::textarea($fieldName, Form::useInitialValue($this->model, $name, $locale), $options),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function checkbox(string $name, string $locale = ''): string
    {
        $fieldName = $this->fieldName($name, $locale);

        $contents = Form::checkbox(
            $fieldName,
            1,
            Form::useInitialValue($this->model, $name, $locale),
            ['class' => 'form-control']
        ).' '.fragment("back.{$this->module}.{$name}");

        return $this->group([el('label.-checkbox', $contents)]);
    }

    public function date(string $name, bool $required = false, string $locale = ''): string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name, $required),
            Form::datePicker($fieldName, Form::useInitialValue($this->model, $name, $locale)),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function select(string $name, $options, string $locale = ''): string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name, true),
            Form::select(
                $fieldName,
                $options,
                Form::useInitialValue($this->model, $name, $locale),
                ['data-select' => 'select']
            ),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function searchableSelect(string $name, $options, string $locale = ''): string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name),
            Form::select(
                $fieldName,
                $options,
                Form::useInitialValue($this->model, $name, $locale),
                ['data-select' => 'search']
            ),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function searchableMultiSelect(string $name, $options, string $locale = ''): string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name),
            Form::select(
                $fieldName,
                $options,
                Form::useInitialValue($this->model, $name, $locale),
                ['data-select' => 'search', 'multiple' => true]
            ),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function tags(string $type): string
    {
        return $this->group([
            Form::label($type.'_tags[]', fragment("back.{$this->module}.{$type}").'*'),
            Form::tags($this->model, $type),
        ]);
    }

    public function category(string $type): string
    {
        return $this->group([
            Form::label($type.'_tags[]', fragment("back.{$this->module}.{$type}").'*'),
            Form::category($this->model, $type, ['data-select' => 'select']),
        ]);
    }

    public function media(string $collection, string $type, array $associated = []): string
    {
        return $this->group([
            $this->label($collection),
            Form::media($this->model, $collection, $type, $associated),
        ]);
    }

    public function map(string $name): string
    {
        $form = [];

        $form[] = el('div', ['class' => 'locationpicker_tools :align-right'], [
            el('input', [
                'type' => 'text',
                'class' => 'locationpicker_search',
                'placeholder' => fragment('back.locationpicker.search'),
                'data-locationpicker-search',
            ], ''),
            el('button', [
                'class' => 'locationpicker_button',
                'type' => 'button',
                'data-locationpicker-button',
            ], fragment('back.locationpicker.submit')),
        ]);

        $form[] = el('div', [
            'class' => 'locationpicker_map',
            'data-locationpicker-map',
        ], '');

        $form[] = Form::hidden(
            "{$name}_lat",
            Form::useInitialValue($this->model, "{$name}_lat"),
            ['data-locationpicker-lat']
        );

        $form[] = Form::hidden(
            "{$name}_lng",
            Form::useInitialValue($this->model, "{$name}_lng"),
            ['data-locationpicker-lng']
        );

        $form[] = Form::hidden(
            "{$name}_zoom",
            Form::useInitialValue($this->model, "{$name}_zoom"),
            ['data-locationpicker-zoom']
        );

        return $this->group([
            $this->label($name),
            el('div.locationpicker', ['data-locationpicker'], $form),
        ]);
    }

    public function translated(array $fields): string
    {
        // Ex. ['name' => 'text', 'contents' => 'redactor']

        $translatedFields = [];

        foreach (config('app.locales') as $locale) {
            $fieldset = [];

            foreach ($fields as $name => $type) {
                $fieldset[] = $this->$type($name, false, $locale);
            }

            $translatedFields[] = $this->languageFieldSet($locale, $fieldset);
        }

        return implode('', $translatedFields);
    }

    public function seo(): string
    {
        return locales()->map(function ($locale) {
            return collect($this->model->defaultSeoValues())
                ->keys()
                ->map(function ($attribute) use ($locale) {
                    $fieldName = translate_field_name("seo.{$attribute}", $locale);

                    return $this->group([
                        Form::label($fieldName, $this->getSeoLabel($attribute)),
                        Form::text(
                            $fieldName,
                            old($fieldName, $this->model->getTranslation('seo_values', $locale)[$attribute] ?? ''),
                            ['placeholder' => $this->model->defaultSeoValues()[$attribute]]
                        ),
                    ]);
                })
                ->pipe(function (Collection $fields) use ($locale) {
                    return $this->languageFieldSet($locale, $fields->toArray());
                });
        })->implode('');
    }

    protected function getSeoLabel(string $attribute): string
    {
        if (starts_with($attribute, 'meta_')) {
            return 'Meta: '.substr($attribute, 5);
        }

        return fragment("back.seo.{$attribute}");
    }

    public function submit(): string
    {
        return el(
            'div.form__group.-buttons',
            Form::submit(fragment("back.{$this->module}.save"), ['class' => 'button -default'])
        );
    }

    protected function languageFieldSet($locale, array $elements)
    {
        return el(
            'fieldset',
            array_merge([el('legend', el('div.legend_lang', $locale))], $elements)
        );
    }

    protected function group(array $elements): string
    {
        return el('div.form__group', $elements);
    }

    protected function parts(array $elements): string
    {
        return el('div.parts', $elements);
    }

    protected function fieldName(string $name, string $locale = ''): string
    {
        return $locale ? translate_field_name($name, $locale) : $name;
    }
}
