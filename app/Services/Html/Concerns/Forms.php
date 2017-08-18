<?php

namespace App\Services\Html\Concerns;

use App\Models\ContentBlock;
use App\Models\Tag;
use App\Models\Transformers\ContentBlockTransformer;
use App\Models\Transformers\MediaTransformer;
use Illuminate\Support\Collection;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Element;
use Spatie\Html\Elements\Input;
use Spatie\Html\Elements\Select;
use Spatie\Html\Elements\Textarea;

trait Forms
{
    public function redactor(string $name = '', ?string $value = ''): Textarea
    {
        $this->ensureModelIsAvailable();

        $medialibraryUrl = action(
            'Back\Api\MediaLibraryController@add',
            ['model_name' => get_class($this->model), 'model_id' => $this->model->id, 'redactor']
        );

        return $this->textarea($name, $value)
            ->attributes([
                'data-editor',
                'data-editor-medialibrary-url' => $medialibraryUrl,
            ]);
    }

    public function date(string $name = '', ?string $value = ''): Input
    {
        return $this->text($name, $value)
            ->attribute('data-datetimepicker')
            ->class('-datetime');
    }

    public function category(string $type): Select
    {
        $this->ensureModelIsAvailable();

        return $this->select(
            "{$type}_tags[]",
            Tag::getWithType($type)->pluck('name', 'name'),
            $this->model->tagsWithType($type)->pluck('name', 'name')
        );
    }

    public function tags(string $type): Select
    {        
        return $this->category($type)
            ->attributes(['multiple', 'data-select' => 'tags'])
            ->value($this->model->tagsWithType($type)->pluck('name', 'name'));
    }

    public function searchableSelect(string $name = '', iterable $options = [], ? string $value = '')
    {
        return $this->select($name, $options, $value)->attribute('data-select', 'search');
    }

    public function media(string $collection, string $type, array $associated = []) : Element
    {
        $this->ensureModelIsAvailable();

        $initial = fractal()
            ->collection($this->model->getMedia($collection))
            ->transformWith(MediaTransformer::class)
            ->toJson();

        $associatedData = collect($associated)->merge([
            'locales' => config('app.locales'),
            'contentLocale' => content_locale(),
        ])->toArray();

        return $this->element('blender-media')->attributes([
            'collection' => $collection,
            'type' => $type,
            'upload-url' => action('Back\Api\MediaLibraryController@add'),
            ':model' => htmlspecialchars($this->getComponentModel()),
            ':initial' => htmlspecialchars($initial),
            ':data' => htmlspecialchars(json_encode($associatedData, JSON_FORCE_OBJECT)),
            ':debug' => htmlspecialchars(json_encode(config('app.debug', false))),
        ]);
    }

    public function contentBlocks(string $collectionName, array $types = null): Div
    {
        $this->ensureModelIsAvailable();

        $initial = fractal()
            ->collection($this->model->getContentBlocks($collectionName))
            ->transformWith(ContentBlockTransformer::class)
            ->toJson();

        $associatedData = collect($types ? ['types' => $types] : [])->merge([
            'locales' => config('app.locales'),
            'contentLocale' => content_locale(),
            'mediaModel' => ContentBlock::class,
            'mediaUploadUrl' => action('Back\Api\MediaLibraryController@add'),
        ])->toArray();

        return $this->formGroup()->withContents($this->element('blender-content-blocks')->attributes([
            'collection' => $collectionName,
            'create-url' => action('Back\Api\ContentBlockController@add'),
            ':model' => htmlspecialchars($this->getComponentModel()),
            ':input' => htmlspecialchars($initial),
            ':data' => htmlspecialchars(json_encode($associatedData)),
            ':debug' => htmlspecialchars(json_encode(config('app.debug', false))),
        ]));
    }

    protected function getComponentModel(): string
    {
        return collect([
            'name' => get_class($this->model),
            'id' => $this->model->id,
        ])->toJson();
    }

    public function map(string $name): Div
    {
        return $this->div()
            ->class('locationpicker')
            ->attribute('data-locationpicker')
            ->attribute('data-api-key', config('google_maps.api_key'))
            ->children([
                $this->div()
                    ->class('locationpicker_tools :align-right')
                    ->children([
                        $this->text()->class('locationpicker_search')->placeholder(__('Zoeken...'))->attribute('data-locationpicker-search'),
                        $this->button(__('Zoeken'), 'button')->class('locationpicker_button')->attribute('data-locationpicker-button'),
                    ]),

                $this->div()->class('locationpicker_map')->attribute('data-locationpicker-map'),

                $this->hidden("{$name}_lat")->attribute('data-locationpicker-lat'),
                $this->hidden("{$name}_lng")->attribute('data-locationpicker-lng'),
                $this->hidden("{$name}_zoom")->attribute('data-locationpicker-zoom'),
            ]);
    }

    public function seo(): Div
    {
        $this->ensureModelIsAvailable();

        $languageFields = locales()->map(function ($locale) {
            return collect($this->model->defaultMetaValues())
                ->keys()
                ->map(function ($attribute) use ($locale) {
                    $this->locale($locale);

                    return $this->formGroup()->withContents([
                        $this->label($this->seoLabel($attribute), $attribute),
                        $this->text()
                            ->name($this->fieldName("seo_{$attribute}"))
                            ->value($this->model->getTranslation('meta_values', $locale)[$attribute] ?? '')
                            ->placeholder($this->model->defaultMetaValues()[$attribute]),
                    ]);
                })
                ->pipe(function (Collection $fields) use ($locale) {
                    $this->endLocale();

                    return $this->translatedFieldset($locale, $fields->toArray());
                });
        });

        return $this->div()->children($languageFields);
    }

    protected function seoLabel(string $attribute): string
    {
        if (starts_with($attribute, 'meta_')) {
            return 'Meta: '.substr($attribute, 5);
        }

        return $attribute;
    }
}
