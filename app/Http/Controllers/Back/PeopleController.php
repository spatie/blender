<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\PersonRequest;
use App\Models\Person;
use Spatie\Blender\Model\Controller;

class PeopleController extends Controller
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
