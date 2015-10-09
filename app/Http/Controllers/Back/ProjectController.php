<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Back\Traits\Orderable;
use App\Models\Project;

class ProjectController extends ModuleController
{
    use Orderable;

    protected $modelName = 'Project';
    protected $moduleName = 'projects';

    /**
     * Return a fresh instance of the model (called on `create()`).
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function make()
    {
        $model = new Project();
        $model->save();

        return $model;
    }
}
