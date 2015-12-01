<?php

namespace App\Models\Foundation\Updaters;

class ModuleModelUpdater extends Updater
{
    use UpdatesMedia, UpdatesOnlineToggle, UpdatesTranslations;

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update()
    {
        $this->updateTranslations();
        $this->updateOnlineToggle();
        $this->updateMedia();

        return $this->model;
    }
}
