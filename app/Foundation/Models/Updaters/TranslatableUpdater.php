<?php

namespace App\Foundation\Models\Updaters;

class TranslatableUpdater extends Updater
{
    use UpdatesTranslations;

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update()
    {
        $this->updateTranslations();

        return $this->model;
    }
}
