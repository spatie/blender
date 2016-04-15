<?php

namespace App\Services\Html;

use App\Models\Enums\TagType;
use App\Models\Tag;
use App\Models\Transformers\MediaTransformer;
use App\Repositories\TagRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Html\FormBuilder as BaseFormBuilder;
use HTML;

class FormBuilder extends BaseFormBuilder
{
    public function openDraftable(array $options, Model $subject) : string
    {
        $identifier = short_class_name($subject) . '_' . ($subject->isDraft() ? 'new' : $subject->id);

        $options = array_merge($options, [
            'data-autosave' => '',
            'name' => $identifier,
            'id' => $identifier,
        ]);

        return $this->open($options);
    }

    public function openButton(array $formOptions = [], array $buttonOptions = []) : string
    {
        if (strtolower($formOptions['method'] ?? '') === 'delete') {
            $formOptions['data-confirm'] = 'true';
        }

        return $this->open($formOptions) . substr(el('button', $buttonOptions, ''), 0, -strlen('</button>'));
    }

    public function closeButton() : string
    {
        return '</button>' . $this->close();
    }

    public function redactor($subject, string $fieldName, string $locale = '', array $options = []) : string
    {
        $initial = $this->useInitialValue($subject, $fieldName, $locale);
        $fieldName = $locale ? translate_field_name($fieldName, $locale) : $fieldName;

        return $this->textarea(
            $fieldName,
            $initial,
            array_merge($options, [
                'data-editor',
                'data-editor-medialibrary-url' => action(
                    'Back\MediaLibraryApiController@add',
                    [short_class_name($subject), $subject->id, 'redactor']
                ),
            ])
        );
    }

    public function checkboxWithLabel($subject, string $fieldName, string $label, array $options = []) : string
    {
        $options = array_merge(['class' => 'form-control'], $options);

        return el('label.-checkbox',
            $this->checkbox($fieldName, 1, $this->useInitialValue($subject, $fieldName), $options)
            . ' ' . $label
        );
    }

    public function datePicker(string $name, string $value) : string
    {
        return $this->text($name, $value, [
            'data-datetimepicker',
            'class' => '-datetime',
        ]);
    }

    public function tags($subject, string $type, array $options = []) : string
    {
        $type = new TagType($type);

        $tags = Tag::getWithType($type)->lists('name', 'name')->toArray();
        $subjectTags = $subject->tagsWithType($type)->lists('name', 'name')->toArray();

        $options = array_merge(['multiple', 'data-select' => 'tags'], $options);

        return $this->select("{$type}_tags[]", $tags, $subjectTags, $options);
    }

    public function category($subject, $type, array $options = []) : string
    {
        $type = new TagType($type);

        $categories = Tag::getWithType($type)->lists('name', 'name')->toArray();
        $subjectCategory = $subject->tagsWithType($type)->first()->name ?? null;

        return $this->select("{$type}_tags[]", $categories, $subjectCategory, $options);
    }

    public function locales(array $locales, string $current) : string
    {
        $list = array_reduce($locales, function (array $list, string $locale) {
            $list[$locale] = trans("locales.{$locale}");
            return $list;
        }, []);

        return $this->select('locale', $list, $current, ['data-select' => 'select']);
    }

    public function media($subject, string $collection, string $type, array $associated = []) : string
    {
        $initialMedia = fractal()
            ->collection($subject->getMedia($collection))
            ->transformWith(new MediaTransformer())
            ->toJson();

        $model = collect([
            'name' => get_class($subject),
            'id' => $subject->id
        ])->toJson();

        $associated = $this->getAssociatedMediaData($associated);

        return el('div', array_merge($associated, [
            'data-media-collection' => $collection,
            'data-media-type' => $type,
            'data-initial' => htmlspecialchars($initialMedia),
            'data-model' => htmlspecialchars($model),
        ]), '');
    }

    protected function getAssociatedMediaData(array $associated = []) : array
    {
        $associated['locales'] = $associated['locales'] ?? config('app.locales');

        $normalized = [];

        foreach ($associated as $key => $value) {
            $normalized["data-{$key}"] = htmlspecialchars(json_encode($value));
        }

        return $normalized;
    }

    public function useInitialValue($subject, string $propertyName, string $locale = '') : string
    {
        $fieldName = $locale ? translate_field_name($propertyName, $locale) : $propertyName;
        $value = $locale ? $subject->translate($propertyName, $locale) : $subject->$propertyName;

        if ($value instanceof Carbon) {
            $value = $value->format('d/m/Y');
        }

        return $this->getValueAttribute($fieldName, $value) ?? '';
    }

    public function getLabelForTranslatedField(string $fieldName, string $label, string $locale) : string
    {
        return HTML::decode(
            $this->label($fieldName, $label . el('span.label_lang', $locale))
        );
    }
}
