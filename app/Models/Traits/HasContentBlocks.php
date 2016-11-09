<?php

/**
 * Reset assured: this will be part of blender-model eventually
 */
namespace App\Models\Traits;

use App\Models\ContentBlock;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContentBlocks
{

    public function contentBlocks(): MorphMany
    {
        return $this->morphMany(ContentBlock::class, 'model');
    }

    /**
     * @param array $attributes
     */
    protected function updateContentBlocks($attributes)
    {
        foreach($attributes as $contentBlockAttributes)
        {
            $contentBlockAttributes = array_merge(['temp' => false], $contentBlockAttributes);

            $this->updateContentBlock($contentBlockAttributes);
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
