<?php

namespace App\Repositories\Database;

use App\Models\Enums\TagType;
use App\Foundation\Models\Traits\HasTags;
use App\Foundation\Repositories\DbRepository;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Support\Collection;

class TagDbRepository extends DbRepository implements TagRepository
{
    public function getAll() : Collection
    {
        return $this->query()
            ->nonDraft()
            ->orderBy('order_column')
            ->orderBy('type')
            ->get();
    }

    public function getAllOnline() : Collection
    {
        return $this->query()
            ->online()
            ->orderBy('order_column')
            ->get();
    }

    public function getAllWithType(TagType $type) : Collection
    {
        return $this->query()
            ->online()
            ->where('type', $type)
            ->orderBy('order_column')
            ->get();
    }

    public function findByName(string $name, TagType $type, $locale = null)
    {
        $type = $type ?: HasTags::getDefaultTagType();
        $locale = $locale ?: HasTags::getDefaultTagLocale();

        return $this->query()
            ->where('type', $type)
            ->whereHas('translations', function ($query) use ($name, $locale) {
                $query->where(compact('name', 'locale'));
            })
            ->first();
    }

    public function findByNameOrCreate(string $name, TagType $type, $locale = null)
    {
        $tag = $this->findByName($name, $type, $locale);

        if ($tag === null) {
            $tag = Tag::createFromName($name, $type);
        }

        return $tag;
    }
}
