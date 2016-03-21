<?php

namespace App\Models\Updaters;

use App\Foundation\Models\Updaters\UpdatesTags;
use App\Models\Enums\TagType;
use Carbon\Carbon;
use App\Foundation\Models\Updaters\ModuleModelUpdater;

class NewsItemUpdater extends ModuleModelUpdater
{
    use UpdatesTags;

    public function performUpdate()
    {
        parent::performUpdate();

        $this->updateTags();

        $this->model->publish_date = Carbon::createFromFormat('d/m/Y', $this->request->get('publish_date'));
    }
}
