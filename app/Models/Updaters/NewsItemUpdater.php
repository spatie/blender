<?php

namespace App\Models\Updaters;

use App\Foundation\Models\Updaters\UpdatesTags;
use App\Models\Enums\TagType;
use Carbon\Carbon;
use App\Foundation\Models\Updaters\ModuleModelUpdater;

class NewsItemUpdater extends ModuleModelUpdater
{
    use UpdatesTags;

    public function update()
    {
        parent::update();

        $this->updateTags(TagType::NEWS_TAG(), TagType::NEWS_CATEGORY());

        $this->model->publish_date = Carbon::createFromFormat('d/m/Y', $this->request->get('publish_date'));
    }
}
