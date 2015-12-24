<?php

namespace App\Foundation\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Spatie\OrAbort\OrAbort;

class BaseRepository
{
    use OrAbort;

    const MODEL = null;

    /** @var \Illuminate\Database\Query\Builder */
    protected $query;

    public function __construct()
    {
        $model = static::MODEL;

        if ($model === null) {
            throw new Exception('No model set for this repository');
        }

        $this->query = $model::query();
    }

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
}
