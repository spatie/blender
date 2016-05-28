<?php

namespace App\Services\Medialibrary;

use ColorThief\ColorThief;
use Illuminate\Contracts\Events\Dispatcher;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;

class MediaLibraryEventHandler
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            MediaHasBeenAdded::class,
            [$this, 'whenMediaHasBeenAdded']
        );
    }

    public function whenMediaHasBeenAdded(MediaHasBeenAdded $event)
    {
        $media = $event->media;

        $dominantColor = ColorThief::getColor($media->getPath());

        $media->setCustomProperty('dominantColor', rgb_to_hex(...$dominantColor));

        $media->save();
    }
}
