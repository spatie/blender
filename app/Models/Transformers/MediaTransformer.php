<?php

namespace App\Models\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\MediaLibrary\Media;

class MediaTransformer extends TransformerAbstract
{
    public function transform(Media $media)
    {
        return [
            'id' => $media->id,
            'name' => $media->name,
            'file_name' => $media->file_name,
            'custom_properties' => $media->custom_properties,
            'order_column' => $media->order_column,
            'thumbUrl' => $media->getUrl('admin'),
            'originalUrl' => $media->getUrl(),
        ];
    }
}
