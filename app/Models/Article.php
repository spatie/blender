<?php

namespace App\Models;

use App\Models\Foundation\Base\ModuleModel;
use App\Models\Foundation\Traits\HasOnlineToggle;
use Carbon\Carbon;

class Article extends ModuleModel
{
    use HasOnlineToggle;

    protected $mediaLibraryCollections = ['images', 'downloads'];
    protected $dates = ['publish_date'];
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

        $this->publish_date = Carbon::createFromFormat('d/m/Y', $attributes['publish_date']);

        return $this;
    }
}
