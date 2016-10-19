<?php

namespace App\Repositories;

use App\Models\Person;
use Illuminate\Support\Collection;

class PersonRepository
{
    public function getAll(): Collection
    {
        return Person::orderBy('publish_date', 'desc')->get();
    }

    public function getAllOnline(): Collection
    {
        return Person::online()
            ->orderBy('publish_date', 'desc')
            ->get();
    }
}
