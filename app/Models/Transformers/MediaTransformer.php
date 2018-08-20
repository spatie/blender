<?php

namespace App\Models\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\MediaLibrary\Models\Media;

class MediaTransformer extends TransformerAbstract
{
    public function transform(Media $media)
    {
        return [
            'id' => $media->id,
            'name' => $media->name,
            'collection' => $media->collection_name,
            'fileName' => $media->file_name,
            'customProperties' => $media->custom_properties,
            'orderColumn' => $media->order_column,
            'thumbUrl' => strtolower($media->extension) === 'svg' ?
                $media->getUrl() :
                $media->getUrl('admin'),
            'originalUrl' => $media->getUrl(),
        ];
    }
}
