<?php

/**
 * Reset assured: this will be part of blender-model eventually
 */
namespace App\Models\Traits;

use App\Http\Requests\Request;
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

    public function syncContentBlocks(Request $request)
    {
        foreach ($this->getCollectionNames() as $collectionName) {

            if ($request->has("contentBlocks.{$collectionName}")) {

                foreach ($request->get("contentBlocks.{$collectionName}") as $collectionValues) {

                    foreach ($collectionValues as $contentBlockValues)
                        $contentBlockAttributes = array_merge(['temp' => false], $contentBlockValues);

                    ContentBlock::findOrFail($contentBlockAttributes['id'])->updateWithValues($contentBlockValues);

                    $this->updateContentBlock($contentBlockAttributes);
                }
            }
        }

        $this->deleteTemporaryContentBlocks();
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
