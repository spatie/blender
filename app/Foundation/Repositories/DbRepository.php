<?php

namespace App\Foundation\Repositories;

use Illuminate\Support\Collection;

abstract class DbRepository extends BaseRepository implements Repository
{
    public function getAll() : Collection
    {
        return $this->query->get();
    }

    /** @return \Illuminate\Database\Eloquent\Model|null */
    public function findById(int $id)
    {
        return $this->query->find($id);
    }
}
