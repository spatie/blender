<?php

namespace App\Models\Updaters;

use App\Models\Foundation\Updaters\ModuleModelUpdater;

class PersonUpdater extends ModuleModelUpdater
{
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update()
    {
        parent::update();

        $this->model->name = $this->request->get('name');

        return $this->model;
    }
}
