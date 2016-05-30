<?php

namespace App\Foundation\Repositories;

use App\Models\Enums\TagType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface Repository
{
    public function getAll():Collection;

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id);

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findOnline(int $id);

    public function getAllOnline():Collection;

    public function getAllOnlineGroupedByTagCategory(TagType $tagType): Collection

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByUrl(string $url);

    public function save(Model $model):bool;

    public function delete(Model $model):bool;
}
