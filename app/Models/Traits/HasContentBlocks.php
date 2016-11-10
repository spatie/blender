<?php

/**
 * Reset assured: this will be part of blender-model eventually
 */
namespace App\Models\Traits;

use App\Models\ContentBlock;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasContentBlocks
{

    public function contentBlocks(): MorphMany
    {
        return $this
            ->morphMany(ContentBlock::class, 'model')
            ->orderBy('order_column', 'desc');
    }

    public function getCollectionNames(): array
    {
        return $this->contentBlockCollections ?? ['default'];
    }

    public function getContentBlocksForCollection($collectionName): Collection
    {
        return $this->contentBlocks
            ->filter(function (ContentBlock $contentBlock) use ($collectionName) {
                return $contentBlock->collection_name === $collectionName;
            });
    }

    /**
     * @param array $attributes
     */
    protected function updateContentBlocks($attributes)
    {
        foreach ($this->getCollectionNames() as $collectionName) {

            foreach ($attributes[$collectionName] as $collectionValues) {

                foreach ($collectionValues as $contentBlockValues)
                    $contentBlockAttributes = array_merge(['temp' => false], $contentBlockValues);

                ContentBlock::findOrFail($contentBlockAttributes['id'])->updateWithValues($contentBlockValues);

                $this->updateContentBlock($contentBlockAttributes);
            }
        }
    }


    public function deleteTemporaryContentBlocks()
    {
        $this->contentBlocks()->get()
            ->filter(function (ContentBlock $contentBlock) {
                return $contentBlock->temp;
            })
            ->each(function (ContentBlock $contentBlock) {
                $contentBlock->delete();
            });
    }
}
