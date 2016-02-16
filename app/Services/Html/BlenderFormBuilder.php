<?php

namespace App\Services\Html;

class BlenderFormBuilder
{
    /**
     * @var string
     */
    protected $module;

    /**
     * @var mixed
     */
    protected $model;

    /**
     * @var \Illuminate\Support\ViewErrorBag
     */
    protected $errors;

    /**
     * @param string                           $module
     * @param mixed                            $model
     * @param \Illuminate\Support\ViewErrorBag $errors
     */
    public function init($module, $model, $errors)
    {
        $this->module = $module;
        $this->model = $model;
        $this->errors = $errors;
    }

    /**
     * @param string $name
     * @param bool   $required
     *
     * @return string
     */
    public function label($name, $required = false)
    {
        return $this->form()->label($name, fragment("back.{$this->module}.{$name}").($required ? '*' : ''));
    }

    /**
     * @param string $name
     * @param string $locale
     *
     * @return string
     */
    public function error($name, $locale = null)
    {
        return $this->html()->error($this->errors->first($name));
    }

    /**
     * @param string $name
     * @param bool   $required
     * @param string $locale
     *
     * @return string
     */
    public function text($name, $required = false, $locale = null)
    {
        $fieldName = $locale ? $this->form()->getTranslatedFieldName($name, $locale) : $name;

        $label = $this->label($name, $required);
        $text = $this->form()->text($fieldName, $this->form()->useInitialValue($this->model, $name, $locale));
        $errors = $this->error($fieldName, $this->errors);

        return $this->wrapInFormGroup($label, $text, $errors);
    }

    /**
     * @param string $name
     * @param bool   $required
     * @param string $locale
     *
     * @return string
     */
    public function textarea($name, $required = false, $locale = null)
    {
        $fieldName = $locale ? $this->form()->getTranslatedFieldName($name, $locale) : $name;

        $label = $this->label($name, $required);
        $text = $this->form()->textarea($fieldName, $this->form()->useInitialValue($this->model, $name, $locale), ['data-autosize' => true]);
        $errors = $this->error($fieldName, $this->errors);

        return $this->wrapInFormGroup($label, $text, $errors);
    }

    /**
     * @param string $name
     * @param bool   $required
     * @param string $locale
     *
     * @return string
     */
    public function redactor($name, $required = false, $locale = null)
    {
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

        $fieldName = $locale ? $this->form()->getTranslatedFieldName($name, $locale) : $name;

        $label = $this->label($name, $required);
        $redactor = $this->form()->textarea($fieldName,
            $this->form()->useInitialValue($this->model, $name, $locale), $options);
        $errors = $this->error($fieldName, $this->errors);

        return $this->wrapInFormGroup($label, $redactor, $errors);
    }

    /**
     * @param string $name
     * @param string $locale
     *
     * @return string
     */
    public function checkbox($name, $locale = null)
    {
        $options = [
            'class' => 'form-control',
        ];

        $labelName = fragment("back.{$this->module}.{$name}");
        $fieldName = $locale ? $this->form()->getTranslatedFieldName($name, $locale) : $name;

        $checkbox = $this->form()->checkbox($fieldName, 1,
            $this->form()->useInitialValue($this->model, $name, $locale), $options);
        $checkboxWithLabel = "<label class=-checkbox>{$checkbox} {$labelName}</label>";

        return $this->wrapInFormGroup($checkboxWithLabel);
    }

    /**
     * @param string $name
     * @param bool   $required
     * @param string $locale
     *
     * @return string
     */
    public function date($name, $required = false, $locale = null)
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
    public function select($name, $options, $locale = null)
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
    public function searchableSelect($name, $options, $locale = null)
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
     * Call the html builder.
     *
     * @return \App\Services\Html\HtmlBuilder
     */
    protected function html()
    {
        return app()->make('html');
    }

    /**
     * Call the form builder.
     *
     * @return \App\Services\Html\FormBuilder
     */
    protected function form()
    {
        return app()->make('form');
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

    /**
     * Wrap an html string in a form_group div.
     *
     * @param string $elements,...
     *
     * @return string
     */
    protected function wrapInFormGroup(...$elements)
    {
        $innerHtml = implode('', $elements);

        return "<div class=form_group>{$innerHtml}</div>";
    }

    /**
     * Wrap an html string in a parts div.
     *
     * @param string $elements,...
     *
     * @return string
     */
    protected function wrapInParts(...$elements)
    {
        $innerHtml = implode('', $elements);

        return "<div class=parts>{$innerHtml}</div>";
    }
}
