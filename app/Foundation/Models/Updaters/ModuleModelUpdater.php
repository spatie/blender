<?php

namespace App\Foundation\Models\Updaters;

class ModuleModelUpdater extends Updater
{
    use UpdatesMedia, UpdatesOnlineToggle, UpdatesSeoValues, UpdatesTranslations;

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function performUpdate()
    {
        $this->updateTranslations();
        $this->updateOnlineToggle();
        $this->updateSeoValues();
        $this->updateMedia();

        return $this->model;
    }
}
