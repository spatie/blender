<?php

namespace App\Foundation\Models\Updaters;

trait UpdatesOnlineToggle
{
    public function updateOnlineToggle()
    {
        $this->model->online = $this->request->has('online') ? $this->request->get('online') : false;
    }
}
