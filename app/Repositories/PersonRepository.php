<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Models\Person;
use Illuminate\Support\Collection;

class PersonRepository extends Repository
{
    const MODEL = Person::class;

    public function getAll(): Collection
    {
        return $this->query()
            ->orderBy('order_column')
            ->get();
    }
}
