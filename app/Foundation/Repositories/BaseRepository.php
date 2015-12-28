<?php

namespace App\Foundation\Repositories;

use Illuminate\Database\Eloquent\Model;
use Spatie\OrAbort\OrAbort;

abstract class BaseRepository
{
    use OrAbort;

    public function save(Model $model) : bool
    {
        $saved = $model->save();

        if ($saved) {
            app('cache')->flush();
        }

        return $saved;
    }

    public function delete(Model $model) : bool
    {
        $deleted = $model->delete();

        if ($deleted) {
            app('cache')->flush();
        }

        return $deleted;
    }

    protected function query()
    {
        return call_user_func(static::MODEL.'::query');
    }
}
