<?php

namespace App\Models\Foundation\Traits;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Note: don't forget to set protected $mediaLibraryCollections.
 */
trait HasMedia
{
    use HasMediaTrait;

    /**
     * @param array $attributes
     */
    protected function updateMediaLibraryFields($attributes)
    {
        if (!isset($this->mediaLibraryCollections)) {
            return;
        }

        foreach ($this->mediaLibraryCollections as $collectionName) {
            if (array_key_exists($collectionName, $attributes)) {
                $updatedMedia = $this->updateMedia(json_decode($attributes[$collectionName], true), $collectionName);
                foreach ($updatedMedia as $mediaItem) {
                    $customProperties = $mediaItem->custom_properties;
                    $customProperties['temp'] = false;
                    $mediaItem->custom_properties = $customProperties;

                    $mediaItem->save();
                }
            }
        }
    }
}
