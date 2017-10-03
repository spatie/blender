<?php

namespace App\Http\Controllers\Back;

use App\Models\Person;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    protected function make(): Person
    {
        return Person::create();
    }

    protected function updateFromRequest(Person $person, Request $request)
    {
        $person->name = $request->get('name');

        $this->updateModel($person, $request);
    }

    protected function validationRules(): array
    {
        return [
            'name' => 'required',
        ];
    }
}
