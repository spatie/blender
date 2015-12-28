<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Models\Enums\TagType;
use App\Models\Tag;
use Illuminate\Support\Collection;

interface TagRepository extends Repository
{
    const MODEL = Tag::class;

    public function getAllOnline() : Collection;

    public function getAllWithType(TagType $type) : Collection;

    public function findByName(string $name, TagType $type, $locale = null);

    public function findByNameOrCreate(string $name, TagType $type, $locale = null);
}
