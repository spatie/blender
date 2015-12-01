<?php

namespace App\Models;

use App\Models\Foundation\Base\ModuleModel;

class Article extends ModuleModel
{
    public $mediaLibraryCollections = ['images', 'downloads'];
    public $translatedAttributes = ['name', 'text', 'url'];

    /**
     * @return bool
     */
    public function isDeletable()
    {
        return !(bool) $this->technical_name;
    }
}
