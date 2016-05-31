<?php

namespace App\Foundation\Repositories;

use App\Models\Enums\TagType;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class DbRepository extends BaseRepository implements Repository
{
    public function getAll(): Collection
    {
        return $this->query()->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        return $this->query()->find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findOnline(int $id)
    {
        return $this->query()->online()->find($id);
    }

    public function getAllOnline(): Collection
    {
        return $this->query()
            ->online()
            ->get();
    }

    public function getAllOnlineGroupedByTagCategory(TagType $tagType): Collection
    {
        $tags = Tag::getWithType($tagType);

        return $this->getAllOnline()
            ->groupBy(function (Model $model) use ($tagType) {
                $firstTag = $model->tagsWithType($tagType)->first();

                if (!$firstTag) {
                    return 0;
                }

                return $firstTag->id;
            })
            ->map(function ($tagIdsWithModels, int $tagId) use ($tags) {
                return [
                    'tag' => $tags->get($tagId),
                    'models' => collect($tagIdsWithModels)->values(),
                ];
            })
            ->sortBy(function (array $tagsAndModels) {
                return $tagsAndModels['tag']->order_column;
            })
            ->values();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByUrl(string $url)
    {
        $model = static::MODEL;

        if (!isset((new $model())->translatedAttributes)) {
            return $this->query()->online()->where('url', $url)->first();
        }

        return $this->query()
            ->online()
            ->whereTranslation('url', $url, content_locale())
            ->first();
    }
}
