<?php

namespace App\Models\Foundation\Updaters;

use Spatie\MediaLibrary\Media;

trait UpdatesMedia
{
    protected function updateMedia()
    {
        if (!isset($this->model->mediaLibraryCollections)) {
            return;
        }

        foreach ($this->model->mediaLibraryCollections as $collection) {

            if (! $this->request->has($collection)) {
                continue;
            }

            $updatedMedia = $this->model->updateMedia(
                json_decode($this->request->get($collection), true),
                $collection
            );

            collect($updatedMedia)->each(function (Media $media) {
                $media->setCustomProperty('temp', false);
                $media->save();
            });
        }
    }
}
