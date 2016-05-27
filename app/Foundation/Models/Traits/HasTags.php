<?php

namespace App\Foundation\Models\Traits;

use App\Models\Enums\TagType;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{
    public function tags():MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tagsWithType(TagType $type):Collection
    {
        return $this->tags->filter(function (Tag $tag) use ($type) {
            return $tag->hasType($type);
        });
    }
}
