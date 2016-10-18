<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\PersonRequest;
use App\Models\Person;

class PeopleController extends ModuleController
{
    protected function make(): Person
    {
        return Person::create();
    }

    protected function updateFromRequest(Person $person, PersonRequest $request)
    {
        $person->name = $request->get('name');

        $this->updateModel($person, $request);
    }
}
