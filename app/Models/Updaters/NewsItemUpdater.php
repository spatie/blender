<?php

namespace App\Models\Updaters;

use App\Foundation\Models\Updaters\UpdatesSeoValues;
use App\Foundation\Models\Updaters\UpdatesTags;
use Carbon\Carbon;
use App\Foundation\Models\Updaters\ModuleModelUpdater;

class NewsItemUpdater extends ModuleModelUpdater
{
    use UpdatesSeoValues, UpdatesTags;

    public function performUpdate()
    {
        parent::performUpdate();

        $this->updateTags();
        $this->updateMetaTags();

        $this->model->publish_date = Carbon::createFromFormat('d/m/Y', $this->request->get('publish_date'));
    }
}
