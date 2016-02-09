<?php

namespace App\Http\Controllers\Back;

use App\Models\Person;

class PersonController extends ModuleController
{
    protected $modelName = 'Person';
    protected $moduleName = 'people';

    protected function make()
    {
        $model = new Person();
        $model->save();

        return $model;
    }
}
