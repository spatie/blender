<?php

namespace App\Models\Transformers;

use App\Models\ContentBlock;
use League\Fractal\TransformerAbstract;

class ContentBlockTransformer extends TransformerAbstract
{
    public function transform(ContentBlock $contentBlock)
    {
        $attributes = [
            'id' => $contentBlock->id,
            'name' => $contentBlock->name,
            'text' => $contentBlock->text,
            'type' => $contentBlock->type,
        ];

        return array_merge($attributes, $this->getMediaAttributes());
    }

    protected function getMediaAttributes(ContentBlock $contentBlock): array
    {
        return array_reduce($contentBlock->mediaLibraryCollections, function ($mediaAttributes, $collectionName) use ($contentBlock) {
            $mediaAttributes[$collectionName] = $contentBlock->getMedia($contentBlock);
        }, []);
    }
}
