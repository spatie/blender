<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Back\Traits\Orderable;
use App\Models\Person;

class PersonController extends ModuleController
{
    use Orderable;

    protected $modelName = 'Person';
    protected $moduleName = 'people';

    /**
     * Return a fresh instance of the model (called on `create()`).
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function make()
    {
        $model = new Person();
        $model->save();

        return $model;
    }
}
