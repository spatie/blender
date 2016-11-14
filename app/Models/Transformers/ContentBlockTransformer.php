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
            'type' => $contentBlock->type,
        ];

        return array_merge(
            $attributes,
            $this->getMediaAttributes($contentBlock),
            $this->getTranslatedAttributes($contentBlock)
        );
    }

    protected function getMediaAttributes(ContentBlock $contentBlock): array
    {
        return array_reduce($contentBlock->getMediaCollectionNames(), function ($mediaAttributes, $collectionName) use ($contentBlock) {
            $mediaAttributes[$collectionName] = $contentBlock->getMedia($collectionName);

            return $mediaAttributes;
        }, []);
    }

    protected function getTranslatedAttributes(ContentBlock $contentBlock): array
    {
        return array_reduce($contentBlock->translatable, function ($translatables, $attribute) use ($contentBlock) {
            foreach (config('app.locales') as $locale) {
                $translatables[$attribute][$locale] = $contentBlock->getTranslation($attribute, $locale);

                return $translatables;
            }
        }, []);
    }
}
