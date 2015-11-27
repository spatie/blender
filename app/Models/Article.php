<?php

namespace App\Models;

use App\Models\Foundation\Base\ModuleModel;
use App\Models\Foundation\Traits\HasOnlineToggle;

class Article extends ModuleModel
{
    use HasOnlineToggle;

    protected $mediaLibraryCollections = ['images', 'downloads'];
    public $translatedAttributes = ['name', 'text', 'url'];

    /**
     * @return bool
     */
    public function isDeletable()
    {
        return !(bool) $this->technical_name;
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function updateWithRelations(array $attributes)
    {
        parent::updateWithRelations($attributes);

        return $this;
    }
}
