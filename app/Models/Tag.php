<?php

namespace App\Models;

use App\Models\Foundation\Base\ModuleModel;
use App\Models\Enums\TagType;
use App\Models\Foundation\Traits\HasTags;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;

class Tag extends ModuleModel implements SortableInterface
{
    use Sortable;

    public $translatedAttributes = ['name', 'url'];

    public function getTypeAttribute()
    {
        return $this->attributes['type'] ?: HasTags::getDefaultTagType();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function newsItems()
    {
        return $this->morphedByMany(NewsItem::class, 'taggable');
    }

    /**
     * @param string      $name
     * @param string|null $type
     *
     * @return Tag
     */
    public static function createFromName($name, $type = null)
    {
        $tag = new static();

        $tag->type = $type;
        $tag->draft = false;
        $tag->online = true;

        foreach (config('app.locales') as $locale) {
            $tag->translateOrNew($locale)->name = $name;
        }

        $tag->save();

        return $tag;
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function updateWithRelations(array $attributes)
    {
        parent::updateWithRelations($attributes);

        $this->type = $attributes['type'];

        return $this;
    }

    /**
     * @return array
     */
    public function getTypeOptions()
    {
        return TagType::toArray();
    }
}
