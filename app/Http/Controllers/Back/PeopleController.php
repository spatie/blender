<?php

namespace App\Http\Controllers\Back;

use App\Models\Person;
use Spatie\Blender\Model\Controller;
use App\Http\Requests\Back\PersonRequest;

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
