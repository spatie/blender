<?php

namespace App\Foundation\Models\Updaters;

class TranslatableUpdater extends Updater
{
    use UpdatesTranslations;

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function performUpdate()
    {
        $this->updateTranslations();

        return $this->model;
    }
}
