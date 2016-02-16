<?php

namespace App\Models\Updaters;

use App\Foundation\Models\Updaters\TranslatableUpdater;

class TagUpdater extends TranslatableUpdater
{
    public function performUpdate()
    {
        parent::performUpdate();

        $this->model->type = $this->request->get('type');
    }
}
