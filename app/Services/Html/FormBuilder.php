<?php

namespace App\Services\Html;

use Html;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\ContentBlock;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\FormBuilder as BaseFormBuilder;
use Spatie\Blender\Model\Transformers\MediaTransformer;
use Spatie\Blender\Model\Transformers\ContentBlockTransformer;

class FormBuilder extends BaseFormBuilder
{
    public function media($subject, string $collection, string $type, $associated = []): string
    {
        $initialMedia = fractal()
            ->collection($subject->getMedia($collection))
            ->transformWith(new MediaTransformer())
            ->toJson();

        $model = collect([
            'name' => get_class($subject),
            'id' => $subject->id,
        ])->toJson();

        return el('blender-media', [
            'collection' => $collection,
            'type' => $type,
            'upload-url' => action('Back\Api\MediaLibraryController@add'),
            ':model' => htmlspecialchars($model),
            ':initial' => htmlspecialchars($initialMedia),
            ':data' => htmlspecialchars($this->getAssociatedData($associated)),
            ':debug' => htmlspecialchars(json_encode(config('app.debug', false))),
        ], '');
    }

    public function contentBlocks(Model $subject, string $collectionName, string $editor, array $associated = []): string
    {
        $initialContentBlocks = fractal()
            ->collection($subject->getContentBlocks($collectionName))
            ->transformWith(new ContentBlockTransformer())
            ->toJson();

        $model = collect([
            'name' => get_class($subject),
            'id' => $subject->id,
        ])->toJson();

        $associatedData = $this->getAssociatedData(array_merge($associated, [
            'locales' => config('app.locales'),
            'contentLocale' => content_locale(),
            'mediaModel' => ContentBlock::class,
            'mediaUploadUrl' => action('Back\Api\MediaLibraryController@add'),
        ]));

        return el('blender-content-blocks', [
            'collection' => $collectionName,
            'editor' => $editor,
            'create-url' => action('Back\Api\ContentBlockController@add'),
            ':model' => htmlspecialchars($model),
            ':input' => htmlspecialchars($initialContentBlocks),
            ':data' => htmlspecialchars($associatedData),
            ':debug' => htmlspecialchars(json_encode(config('app.debug', false))),
        ], '');
    }

    protected function getAssociatedData($associated = []): string
    {
        $associated = collect($associated);

        $associated->put('locales', config('app.locales'));
        $associated->put('contentLocale', content_locale());

        return $associated->toJson();
    }
}
