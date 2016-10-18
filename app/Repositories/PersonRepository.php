<?php

namespace App\Repositories;

use App\Models\Person;
use Illuminate\Support\Collection;
use Spatie\Blender\Model\Repository;

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
