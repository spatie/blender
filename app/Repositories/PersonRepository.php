<?php

namespace App\Repositories;

use App\Models\Person;
use Illuminate\Support\Collection;

class PersonRepository
{
    public static function getAll(): Collection
    {
        return Person::orderBy('publish_date', 'desc')->get();
    }
}
