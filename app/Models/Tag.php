<?php

namespace App\Models;

use App\Models\Enums\TagType;
use App\Models\Presenters\TagPresenter;
use Spatie\Blender\Model\Model;
use Spatie\Blender\Model\Traits\HasSlug;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Tag extends Model implements Sortable
{
    use HasSlug, SortableTrait, TagPresenter;

    public $translatable = ['name', 'url'];

    public function hasType(TagType $type): bool
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

    public static function findByNameOrCreate(string $name, TagType $type): Tag
    {
        $existing = self::nonDraft()->get()
            ->first(function (Tag $tag, int $id) use ($name, $type) {
                return $tag->translate('name', content_locale()) === $name && $tag->type === (string) $type;
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
