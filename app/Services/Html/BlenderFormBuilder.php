<?php

namespace App\Services\Html;

use Form;
use HTML;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Database\Eloquent\Model;

class BlenderFormBuilder
{
    /** @var string */
    protected $module;

    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;

    /** @var \Illuminate\Contracts\Support\MessageBag */
    protected $errors;

    public function init(string $module, Model $model, MessageBag $errors)
    {
        $this->module = $module;
        $this->model = $model;
        $this->errors = $errors;
    }

    public function label(string $name, bool $required = false, array $options = []) : string
    {
        return Form::label($name, fragment("back.{$this->module}.{$name}") . ($required ? '*' : ''), $options);
    }

    public function error(string $name) : string
    {
        return HTML::error($this->errors->first($name));
    }

    public function text(string $name, bool $required = false, string $locale = '') : string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name, $required),
            Form::text($fieldName, Form::useInitialValue($this->model, $name, $locale)),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function textarea(string $name, bool $required = false, string $locale = '') : string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name, $required),
            Form::textarea($fieldName, Form::useInitialValue($this->model, $name, $locale), ['data-autosize']),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function redactor(string $name, bool $required = false, string $locale = '') : string
    {
        $fieldName = $this->fieldName($name, $locale);

        $options = [
            'data-editor' => '',
            'data-editor-medialibrary-url' => action(
                'Back\MediaLibraryApiController@index',
                [
                    'model_name' => get_class($this->model),
                    'model_id' => $this->model->id,
                ]
            ),
        ];

        return $this->group([
            $this->label($name, $required),
            Form::textarea($fieldName, Form::useInitialValue($this->model, $name, $locale), $options),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function checkbox(string $name, string $locale = '') : string
    {
        $fieldName = $this->fieldName($name, $locale);

        $contents = Form::checkbox($fieldName, 1, Form::useInitialValue($this->model, $name, $locale),
            ['class' => 'form-control']) . ' ' . fragment("back.{$this->module}.{$name}");

        return $this->group([el('label.-checkbox', $contents)]);
    }

    public function date(string $name, bool $required = false, string $locale = '') : string
    {
        $fieldName = $this->fieldName($name, $locale);

        return $this->group([
            $this->label($name, $required),
            Form::datePicker($fieldName, Form::useInitialValue($this->model, $name, $locale)),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function select(string $name, $options, string $locale = '') : string
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

    public function searchableSelect(string $name, $options, string $locale = '') : string
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

    public function tags(string $type) : string
    {
        return $this->group([
            Form::label($type.'_tags[]', fragment("back.{$this->module}.{$type}") . '*'),
            Form::tags($this->model, $type),
        ]);
    }

    public function category(string $type) : string
    {
        return $this->group([
            Form::label($type.'_tags[]', fragment("back.{$this->module}.{$type}") . '*'),
            Form::category($this->model, $type, ['data-select'=>'select']),
        ]);
    }

    public function media(string $collection, string $type, array $associated = []) : string
    {
        return $this->group([
            $this->label($collection),
            Form::media($this->model, $collection, $type, $associated),
        ]);
    }

    public function map($name)
    {
        $label = $this->label($name);
        $text = "<input type='text' class='locationpicker_search' data-locationpicker-search placeholder='".fragment('back.locationpicker.search')."'>";
        $button = "<button class='locationpicker_button' type='button' data-locationpicker-button>".fragment('back.locationpicker.submit').'</button>';
        $map = "<div class='locationpicker_map' data-locationpicker-map></div>";

        $lat = $this->form()->hidden(
            "{$name}_lat",
            $this->form()->useInitialValue($this->model, "{$name}_lat"),
            ['data-locationpicker-lat' => '']
        );

        $lng = $this->form()->hidden(
            "{$name}_lng",
            $this->form()->useInitialValue($this->model, "{$name}_lng"),
            ['data-locationpicker-lng' => '']
        );

        $zoom = $this->form()->hidden(
            "{$name}_zoom",
            $this->form()->useInitialValue($this->model, "{$name}_zoom"),
            ['data-locationpicker-zoom' => '']
        );

        $pickerTools = "<div class='locationpicker_tools :align-right'>{$text}{$button}</div>";
        $picker = "<div class='locationpicker' id='custom_id' data-locationpicker>{$pickerTools}{$map}{$lat}{$lng}{$zoom}</div>";

        return $this->wrapInFormGroup($label, $picker);
    }

    public function translated(array $fields) : string
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

    public function submit() : string
    {
        return el('div.form_group.-buttons',
            Form::submit(fragment("back.{$this->module}.save"), ['class' => 'button -default'])
        );
    }

    protected function languageFieldSet($locale, array $elements)
    {
        return el('fieldset',
            el('legend',
                array_merge(el('div.legend_lang', $locale), $elements)
            )
        );
    }

    protected function group(array $elements) : string
    {
        return el('div.form_group', $elements);
    }

    protected function parts(array $elements) : string
    {
        return el('div.parts', $elements);
    }

    protected function fieldName(string $name, string $locale = '')
    {
        return $locale ? translate_field_name($name, $locale) : $name;
    }
}
