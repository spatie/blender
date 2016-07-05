<?php

namespace App\Models\Updaters;

use App\Foundation\Models\Updaters\ModuleModelUpdater;

class ArticleUpdater extends ModuleModelUpdater
{
    public function performUpdate()
    {
        parent::performUpdate();

        $parentId = $this->request->get('parent_id') == 0 ? null : $this->request->get('parent_id');

        $this->model->parent_id = $parentId;
    }

}
