<?php

namespace App\Services\Html;

use App\Repositories\TagRepository;
use Carbon\Carbon;
use Illuminate\Html\FormBuilder as BaseFormBuilder;
use HTML;
use Form;
use URL;

class FormBuilder extends BaseFormBuilder
{
    public function openDraftable($options)
    {
        if (isset($options['subject'])) {
            $subject = $options['subject'];
            $draftableIdentifier = short_class_name($subject).'_'.($subject->isDraft() ? 'new' : $subject->id);

            $options = array_merge($options, [
                'data-autosave' => '',
                'name' => $draftableIdentifier,
                'id' => $draftableIdentifier,
            ]);
            unset($options['subject']);
        }

        return Form::open($options);
    }

    public function redactor($subject, $fieldName, $locale = '', $options = [])
    {
        return Form::textarea(
            Form::getTranslatedFieldName($fieldName, $locale),
            Form::useInitialValue($subject, $fieldName, $locale),
            array_merge($options,
                [
                    'data-redactor' => '',
                    'data-redactor-medialibrary-url' => URL::action('Back\MediaLibraryApiController@add', [short_class_name($subject), $subject->id, 'redactor']),
                ]));
    }

    public function checkboxWithLabel($subject, $fieldName, $label, $options = [])
    {
        $options = array_merge(['class' => 'form-control'], $options);

        return
            '<label class="-checkbox">'.
                Form::checkbox($fieldName, 1, Form::useInitialValue($subject, $fieldName), $options).' '.
                $label.
            '</label>';
    }

    public function datePicker($name, $value)
    {
        return Form::text($name, $value, [
            'data-datetimepicker',
            'class' => '-datetime',
        ]);
    }

    public function getTranslatedFieldName($fieldName, $locale)
    {
        if ($locale == '') {
            return $fieldName;
        }

        return translate_field_name($fieldName, $locale);
    }

    public function getLabelForTranslatedField($fieldName, $label, $locale)
    {
        return HTML::decode(Form::label($fieldName, $label.' <span class="label_lang">'.$locale.'</span>'));
    }

    public function useInitialValue($subject, $propertyName, $locale = '')
    {
        $value = ($locale == '' ? $subject->$propertyName : $subject->translate($locale)->$propertyName);

        if ($value instanceof Carbon) {
            $value = $value->format('d/m/Y');
        }

        return Form::getValueAttribute($locale == '' ? $propertyName : Form::getTranslatedFieldName($propertyName, $locale), $value);
    }

    public function tags($subject, $type = null)
    {
        $allTags = app()->make(TagRepository::class)->getAllWithType($type)->lists('name', 'name');

        return Form::select(
            $type.'_tags[]',
            $allTags,
            $subject->tags->lists('name')->toArray(),
            ['multiple' => true, 'data-select' => 'tags']
        );
    }

    public function category($subject, $type = null)
    {
        $allCategories = app()->make(TagRepository::class)->getAllWithType($type)->lists('name', 'name')->toArray();

        return $this->select(
            $type.'_tags[]',
            $allCategories,
            $subject->getTags($type)->first() ? $subject->getTags($type)->first()->name : null
        );
    }

    public function locales($locales, $current)
    {
        $list = [];
        foreach ($locales as $locale) {
            $list[$locale] = trans('locales.'.$locale);
        }

        return Form::select('locale', $list, $current, ['data-select' => 'select']);
    }

    public function uploadImages($subject, $collectionName)
    {
        $columns = [
            ['data' => 'path', 'title' => '', 'media' => 'image'],
            ['data' => 'name', 'title' => trans('back.name'), 'editable' => 'text'],
        ];

        return $this->uploader($subject, $collectionName, $columns, true);
    }

    public function uploadDownloads($subject, $collectionName)
    {
        $columns = [
            ['data' => 'path', 'title' => '', 'media' => 'download'],
            ['data' => 'name', 'title' => trans('back.name'), 'editable' => 'text'],
        ];

        return $this->uploader($subject, $collectionName, $columns, false);
    }

    public function uploader($subject, $collectionName, $columns, $onlyImages = false)
    {
        $serverURL = URL::action('Back\MediaLibraryApiController@add', [short_class_name($subject), $subject->id, $collectionName]);

        return Form::textarea($collectionName, $subject->getMedia($collectionName)->toJson(), [
            'data-parts' => json_encode(
                [
                    'debug' => true,
                    'primaryKeyName' => 'id',
                    'orderRows' => true,
                    'dataTableOptions' => [
                        'searching' => false,
                        'info' => false,
                    ],
                    'columns' => $columns,
                    'upload' => [
                        'url' => $serverURL,
                        'label' => $onlyImages ? trans('back.addImage') : trans('back.addFile'),
                        'validation' => [
                            'acceptFileTypes' => ($onlyImages ? 'images' : ''),
                            'maxFileSize' => config('mediaLibrary.maxFileSize'),
                        ],
                    ],
                ], JSON_FORCE_OBJECT),
        ]);
    }
}
