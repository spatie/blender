<?php

namespace App\Models;

use App\Foundation\Models\Base\ModuleModel;
use App\Models\Enums\TagType;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;

class Tag extends ModuleModel implements SortableInterface
{
    use Sortable;

    protected $with = ['translations'];

    public $translatedAttributes = ['name', 'url', 'description'];

    public function hasType(TagType $type) : bool
    {
        return $this->type === $type->getValue();
    }

    public function scopeWithType($query, TagType $type)
    {
        return $query->nonDraft()->where('type', $type->getValue());
    }

    public static function getWithType(TagType $type)
    {
        return static::withType($type)->get();
    }

    public static function findByNameOrCreate(string $name, TagType $type) : Tag
    {
        $existing = Tag::whereTranslation('name', $name, content_locale())->first();

        if ($existing) {
            return $existing;
        }

        $tag = new static([
            'type' => $type,
            'draft' => false,
            'online' => true,
        ]);

        foreach (config('app.locales') as $locale) {
            $tag->translateOrNew($locale)->name = $name;
        }

        $tag->save();

        return $tag;
    }
}
