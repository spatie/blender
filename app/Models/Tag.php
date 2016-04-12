<?php

namespace App\Models;

use App\Foundation\Models\Base\ModuleModel;
use App\Foundation\Models\Traits\HasUrl;
use App\Models\Enums\TagType;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableInterface;

class Tag extends ModuleModel implements SortableInterface
{
    use HasUrl, Sortable;

    protected $with = ['translations'];

    public $translatable = ['name', 'url'];

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
        $existing = Tag::nonDraft()->get()
            ->first(function (Tag $tag) use ($name) {
                return $tag->translate('name', content_locale()) === $name;
            });

        if ($existing) {
            return $existing;
        }

        $tag = new static([
            'type' => $type,
            'draft' => false,
            'online' => true,
        ]);

        $tag->setTranslations('name', array_fill_keys(config('app.locales'), $name));

        $tag->save();

        return $tag;
    }
}
