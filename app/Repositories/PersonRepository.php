<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Models\Person;
use Illuminate\Support\Collection;

interface PersonRepository extends Repository
{
    const MODEL = Person::class;

    public function getAllOnline() : Collection;
}
