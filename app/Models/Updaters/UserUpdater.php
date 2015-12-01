<?php

namespace App\Models\Updaters;

use App\Models\Foundation\Updaters\Updater;

class UserUpdater extends Updater
{
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update()
    {
        $this->updateFields();
        $this->updatePassword();

        return $this->model;
    }

    protected function updateFields()
    {
        $this->model->email = $this->request->get('email');
        $this->model->first_name = $this->request->get('first_name');
        $this->model->last_name = $this->request->get('last_name');
        $this->model->locale = $this->request->get('locale', 'nl');
        $this->model->address = $this->request->get('address', '');
        $this->model->postal = $this->request->get('postal', '');
        $this->model->city = $this->request->get('city', '');
        $this->model->country = $this->request->get('country', '');
        $this->model->telephone = $this->request->get('telephone', '');
    }

    protected function updatePassword()
    {
        if ($this->request->has('password')) {
            return;
        }

        if($this->request->get('password') !== '') {
            return;
        }

        $this->model->password = $this->request->get('password');
    }
}
