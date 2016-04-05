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
        $fieldName = $this->fieldName($name);

        return $this->group([
            $this->label($name, $required),
            Form::text($fieldName, Form::useInitialValue($this->model, $name, $locale)),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function textarea(string $name, bool $required = false, string $locale = '') : string
    {
        $fieldName = $this->fieldName($name);

        return $this->group([
            $this->label($name, $required),
            Form::textarea($fieldName, Form::useInitialValue($this->model, $name, $locale), ['data-autosize']),
            $this->error($fieldName, $this->errors),
        ]);
    }

    public function redactor(string $name, bool $required = false, string $locale = '') : string
    {
        $fieldName = $this->fieldName($name);

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
        $fieldName = $this->fieldName($name);

        $contents = Form::checkbox($fieldName, 1, Form::useInitialValue($this->model, $name, $locale),
            ['class' => 'form-control']) . ' ' . fragment("back.{$this->module}.{$name}");

        return $this->group(el('label.-checkbox', $contents));
    }

    /**
     * @param string $name
     * @param bool   $required
     * @param string $locale
     *
     * @return string
     */
    public function date($name, $required = false, string $locale = '')
    {
        $fieldName = $locale ? $this->form()->getTranslatedFieldName($name, $locale) : $name;

        $label = $this->label($name, $required);
        $datePicker = $this->form()->datePicker($fieldName, $this->form()->useInitialValue($this->model, $name, $locale));
        $errors = $this->error($fieldName, $this->errors);

        return $this->wrapInFormGroup($label, $datePicker, $errors);
    }

    /**
     * @param string $name
     * @param array  $options
     * @param string $locale
     *
     * @return string
     */
    public function select($name, $options, string $locale = '')
    {
        $fieldName = $locale ? $this->form()->getTranslatedFieldName($name, $locale) : $name;

        $label = $this->label($name);
        $select = $this->form()->select($fieldName, $options,
            $this->form()->useInitialValue($this->model, $name, $locale), ['data-select' => 'select']);
        $errors = $this->error($fieldName, $this->errors);

        return $this->wrapInFormGroup($label, $select, $errors);
    }

    /**
     * @param string $name
     * @param array  $options
     * @param string $locale
     *
     * @return string
     */
    public function searchableSelect($name, $options, string $locale = '')
    {
        $fieldName = $locale ? $this->form()->getTranslatedFieldName($name, $locale) : $name;

        $label = $this->label($name);
        $select = $this->form()->select($fieldName, $options,
            $this->form()->useInitialValue($this->model, $name, $locale), ['data-select' => 'search']);
        $errors = $this->error($fieldName, $this->errors);

        return $this->wrapInFormGroup($label, $select, $errors);
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function tags($type)
    {
        $label = $this->form()->label($type.'_tags[]', fragment("back.{$this->module}.{$type}"));
        $tags = $this->form()->tags($this->model, $type);

        return $this->wrapInFormGroup($label, $tags);
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function category($type)
    {
        $label = $this->form()->label($type.'_tags[]', fragment("back.{$this->module}.{$type}"));
        $tags = $this->form()->category($this->model, $type, ['data-select'=>'select']);

        return $this->wrapInFormGroup($label, $tags);
    }

    /**
     * @param string $collection
     * @param string $type
     * @param array  $associated
     *
     * @return string
     */
    public function media($collection, $type, $associated = [])
    {
        $label = $this->label($collection);
        $media = $this->form()->media($this->model, $collection, $type, $associated);

        return $this->wrapInFormGroup($label, $media);
    }

    /**
     * @param string $name
     *
     * @return string
     */
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

    /**
     * @param array $fields Ex. ['name' => 'text', 'contents' => 'redactor']
     *
     * @return string
     */
    public function translated($fields)
    {
        $translatedFieldsHtml = '';

        foreach (config('app.locales') as $locale) {
            $fieldset = [];

            foreach ($fields as $name => $type) {
                $fieldset[] = $this->$type($name, false, $locale);
            }

            $translatedFieldsHtml .= $this->wrapInLanguageField($locale, ...$fieldset);
        }

        return $translatedFieldsHtml;
    }

    /**
     * @return string
     */
    public function submit()
    {
        $submit = $this->form()->submit(fragment("back.{$this->module}.save"), ['class' => 'button -default']);

        return "<div class=\"form_group -buttons\">{$submit}</div>";
    }

    /**
     * Wrap an html string in a fieldset with a legend.
     *
     * @param string $locale
     * @param string $elements,...
     *
     * @return string
     */
    protected function wrapInLanguageField($locale, ...$elements)
    {
        $innerHtml = implode('', $elements);

        return "<fieldset><legend><span class=legend_lang>{$locale}</span></legend>{$innerHtml}</fieldset>";
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
