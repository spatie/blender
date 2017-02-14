<?php

namespace App\Services\Html\Concerns;

use App\Models\ContentBlock;
use App\Models\Tag;
use Spatie\Blender\Model\Transformers\ContentBlockTransformer;
use Spatie\Blender\Model\Transformers\MediaTransformer;
use Spatie\Html\Elements\Div;
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
            [class_basename($this->model), $this->model->id, 'redactor']
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
        return $this->category($type)->attributes(['multiple', 'data-select' => 'tags']);
    }

    public function media(string $collection, string $type, array $associated = []): Div
    {
        $this->ensureModelIsAvailable();

        $initial = fractal()
            ->collection($this->model->getMedia($collection))
            ->transformWith(MediaTransformer::class)
            ->toJson();

        $associatedData = collect($associated)->merge([
            'locales' => config('app.locales'),
            'contentLocale' => content_locale(),
        ])->toJson();

        return $this->formGroup()->withContents($this->element('blender-media')->attributes([
            'collection' => $collection,
            'type' => $type,
            'upload-url' => action('Back\Api\MediaLibraryController@add'),
            ':model' => htmlspecialchars($this->getComponentModel()),
            ':initial' => htmlspecialchars($initial),
            ':data' => htmlspecialchars(collect($associatedData)),
            ':debug' => htmlspecialchars(json_encode(config('app.debug', false))),
        ]));
    }

    public function contentBlocks(string $collectionName, string $editor, array $associated = []): Div
    {
        $this->ensureModelIsAvailable();

        $initial = fractal()
            ->collection($this->model->getContentBlocks($collectionName))
            ->transformWith(ContentBlockTransformer::class)
            ->toJson();

        $associatedData = collect($associated)->merge([
            'locales' => config('app.locales'),
            'contentLocale' => content_locale(),
            'mediaModel' => ContentBlock::class,
            'mediaUploadUrl' => action('Back\Api\MediaLibraryController@add'),
        ])->toJson();

        return $this->formGroup()->withContents($this->element('blender-content-blocks')->attributes([
            'collection' => $collectionName,
            'editor' => $editor,
            'create-url' => action('Back\Api\ContentBlockController@add'),
            ':model' => htmlspecialchars($this->getComponentModel()),
            ':input' => htmlspecialchars($initial),
            ':data' => htmlspecialchars($associatedData),
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
}
