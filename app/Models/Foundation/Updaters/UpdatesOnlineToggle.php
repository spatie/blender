<?php

namespace App\Models\Foundation\Updaters;

trait UpdatesOnlineToggle
{
    public function updateOnlineToggle()
    {
        $this->model->online = $this->request->has('online') ? $this->request->get('online') : false;
    }
}
