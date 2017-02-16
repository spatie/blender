<?php

namespace App\Services\Html;

use Form;
use Illuminate\Database\Eloquent\Model;

class BlenderFormBuilder
{
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
            el('div.locationpicker', ['data-locationpicker', 'data-api-key' => env('GOOGLE_MAPS_API_KEY')], $form),
        ]);
    }
}
