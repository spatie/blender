<?php

namespace App\Http\Controllers\Back;

use App\Models\Project;

class ProjectController extends ModuleController
{
    protected $modelName = 'Project';
    protected $moduleName = 'projects';

    protected function make()
    {
        $model = new Project();
        $model->save();

        return $model;
    }
}
