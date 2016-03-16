<?php

namespace App\Repositories;

use App\Foundation\Repositories\Repository;
use App\Models\Person;

interface PersonRepository extends Repository
{
    const MODEL = Person::class;
}
