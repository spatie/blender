<?php

namespace App\Models\Updaters;

use Carbon\Carbon;
use App\Models\Foundation\Updaters\ModuleModelUpdater;

class NewsItemUpdater extends ModuleModelUpdater
{
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update()
    {
        parent::update();

        $this->model->publish_date = Carbon::createFromFormat('d/m/Y', $this->request->get('publish_date'));

        return $this->model;
    }
}
