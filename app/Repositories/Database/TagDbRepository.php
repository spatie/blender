<?php

namespace App\Repositories\Database;

use App\Models\Enums\TagType;
use App\Foundation\Models\Traits\HasTags;
use App\Foundation\Repositories\DbRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\Collection;

class TagDbRepository extends DbRepository implements TagRepository
{
    public function getAll() : Collection
    {
        return $this->model
            ->newQuery()
            ->with(['translations' => function ($query) {
                $query->where('locale', content_locale());
            }])
            ->nonDraft()
            ->orderBy('order_column')
            ->orderBy('type')
            ->get();
    }

    public function getAllOnline() : Collection
    {
        $query = $this->model->newQuery();

        return $query
            ->online()
            ->orderBy('order_column')
            ->get();
    }

    public function getAllWithType(TagType $type) : Collection
    {
        return $this->model->newQuery()
            ->where('type', $type)
            ->online()
            ->orderBy('order_column')
            ->get();
    }

    public function findByName(string $name, TagType $type, $locale = null)
    {
        $type = $type ?: HasTags::getDefaultTagType();
        $locale = $locale ?: HasTags::getDefaultTagLocale();

        return $this->model
            ->where('type', $type)
            ->whereHas('translations', function ($q) use ($name, $locale) {
                $q
                    ->where('name', $name)
                    ->where('locale', $locale);
            })
            ->first();
    }

    public function findByNameOrCreate(string $name, TagType $type, $locale = null)
    {
        $tag = $this->findByName($name, $type, $locale);

        if ($tag === null) {
            $tag = $this->model->createFromName($name, $type);
        }

        return $tag;
    }
}
