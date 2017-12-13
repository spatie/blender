<?php

namespace App\Models;

use App\Models\Traits\Draftable;
use Illuminate\Support\Facades\DB;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag implements Sortable
{
    use Draftable, SortableTrait;

    protected $types = [
        'newsCategory',
        'newsTag',
    ];

    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasType(string $type): bool
    {
        return $this->type === $type;
    }

    public static function findOrCreate($name, string $type = null, string $locale = null): self
    {
        if ($existingTag = parent::findFromString($name, $type, $locale)) {
            return $existingTag;
        }

        $tag = parent::findOrCreate($name, $type);

        $tag->setTranslations('name', array_fill_keys(config('app.locales'), $name));

        $tag->save();

        return $tag;
    }

    public function getTaggableCountAttribute(): int
    {
        return DB::table('taggables')
            ->where('tag_id', $this->id)
            ->count();
    }

    public static function types(): array
    {
        return (new static)->types;
    }

    public static function typesForSelect(): array
    {
        return collect(static::types())->mapWithKeys(function (string $type) {
            return [$type => __("back.tags.{$type}")];
        })->toArray();
    }
}
