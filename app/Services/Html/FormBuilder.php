<?php

namespace App\Services\Html;

use App\Models\Enums\TagType;
use App\Models\Tag;
use App\Models\Transformers\MediaTransformer;
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

    public function tags($subject, $type)
    {
        $type = new TagType($type);

        $tags = Tag::withType($type)->get()->lists('name', 'name')->toArray();
        $subjectTags = $subject->tagsWithType($type)->lists('name', 'name')->toArray();

        return Form::select(
            $type.'_tags[]',
            $tags,
            $subjectTags,
            ['multiple' => true, 'data-select' => 'tags']
        );
    }

    public function category($subject, $type, $options)
    {
        $type = new TagType($type);

        $categories = Tag::withType($type)->get()->lists('name', 'name')->toArray();
        $subjectCategory = $subject->tagsWithType($type)->first();

        return $this->select(
            $type.'_tags[]',
            $categories,
            $subjectCategory ? $subjectCategory->name : null,
            $options ? $options : null
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

    public function media($subject, $collection, $type, $associated = [])
    {
        $initialMedia = htmlspecialchars(fractal()
            ->collection($subject->getMedia($collection))
            ->transformWith(new MediaTransformer())
            ->toJson());

        $model = htmlspecialchars(collect(['name' => get_class($subject), 'id' => $subject->id]));

        if (!array_key_exists('locales', $associated)) {
            $associated['locales'] = config('app.locales');
        }

        $associatedData = collect($associated)->map(function ($data, $key) {
            $json = htmlspecialchars(json_encode($data));

            return "data-{$key}=\"{$json}\"";
        })->implode(' ');

        return "<div data-media-collection=\"{$collection}\"
                     data-media-type=\"{$type}\"
                     data-initial=\"{$initialMedia}\"
                     data-model=\"{$model}\"
                     {$associatedData}>
                </div>";
    }
}
