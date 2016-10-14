<?php

namespace App\Models\Updaters;

use App\Foundation\Models\Updaters\ModuleModelUpdater;

class RedirectUpdater extends ModuleModelUpdater
{
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function performUpdate()
    {
        $this->model->old_url = $this->request->get('old_url');
        $this->model->new_url = $this->request->get('new_url');
    }
}
