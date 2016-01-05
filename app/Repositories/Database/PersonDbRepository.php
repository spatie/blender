<?php

namespace App\Repositories\Database;

use App\Foundation\Repositories\DbRepository;
use App\Repositories\PersonRepository;
use Illuminate\Support\Collection;

class PersonDbRepository extends DbRepository implements PersonRepository
{
    public function getAll() : Collection
    {
        return $this->query()
            ->orderBy('order_column')
            ->get();
    }

    public function getAllOnline() : Collection
    {
        return $this->query()
            ->online()
            ->orderBy('order_column')
            ->get();
    }
}
