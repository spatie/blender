<?php

/**
 * Reset assured: this will be part of blender-model eventually.
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

    public function getContentBlockCollectionNames(): array
    {
        return $this->contentBlockCollections ?? ['default'];
    }

    public function getContentBlockMediaLibraryCollections(): array
    {
        return $this->contentBlockMediaLibraryCollections ?? [];
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
        foreach ($this->getContentBlockCollectionNames() as $collectionName) {
            if ($request->has("content_blocks_{$collectionName}")) {
                $data = json_decode($request->get("content_blocks_{$collectionName}"), true);
                $this->syncContentBlockCollection($data, $collectionName);
            }
        }

        $this->deleteTemporaryContentBlocks();
    }

    protected function syncContentBlockCollection(array $data, string $collection)
    {
        $contentBlocks = collect($data)->map(function (array $contentBlockAttributes): ContentBlock {
            return ContentBlock::findOrFail($contentBlockAttributes['id'])->updateWithValues(
                array_merge(['draft' => false], $contentBlockAttributes)
            );
        });

        $this->contentBlocks()
            ->where('collection_name', $collection)
            ->whereNotIn('id', $contentBlocks->pluck('id')->toArray())
            ->delete();
    }

    public function deleteTemporaryContentBlocks()
    {
        $this->contentBlocks()->get()
            ->filter(function (ContentBlock $contentBlock) {
                return $contentBlock->draft;
            })
            ->each(function (ContentBlock $contentBlock) {
                $contentBlock->delete();
            });
    }
}
