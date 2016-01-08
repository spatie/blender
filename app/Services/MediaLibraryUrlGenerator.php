<?php

namespace App\Services;

use Spatie\MediaLibrary\UrlGenerator\LocalUrlGenerator;

class MediaLibraryUrlGenerator extends LocalUrlGenerator
{
    /**
     * Get the url for the profile of a media item.
     *
     * @throws \Spatie\MediaLibrary\Exceptions\UrlCouldNotBeDetermined
     */
    public function getUrl() :  string
    {
        return '/media/'.$this->getPathRelativeToRoot();
    }
}
