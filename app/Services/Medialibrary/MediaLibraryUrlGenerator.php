<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\UrlGenerator\LocalUrlGenerator;

class MediaLibraryUrlGenerator extends LocalUrlGenerator
{
    public function getUrl() :  string
    {
        return '/media/'.$this->getPathRelativeToRoot();
    }
}
