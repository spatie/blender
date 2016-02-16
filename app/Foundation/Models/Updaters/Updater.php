<?php

namespace App\Foundation\Models\Updaters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Updater
{
    /** @var \Illuminate\Http\Request */
    protected $request;

    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;

    /** @return \Illuminate\Database\Eloquent\Model */
    abstract public function performUpdate();

    public static function update(Model $model, Request $request)
    {
        $updater = new static();

        $updater->model = $model;
        $updater->request = $request;

        $updater->performUpdate();
    }
}
