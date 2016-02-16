<?php

namespace App\Services\Auth\Back;

use App\Foundation\Models\Updaters\Updater;

class UserUpdater extends Updater
{
    /** @var \App\Services\Auth\Back\User */
    protected $model;

    public function performUpdate()
    {
        $this->model->email = $this->request->get('email');
        $this->model->first_name = $this->request->get('first_name');
        $this->model->last_name = $this->request->get('last_name');
        $this->model->locale = $this->request->get('locale', 'nl');

        if ($this->request->has('password')) {
            $this->model->password = $this->request->get('password');
        }
    }
}
