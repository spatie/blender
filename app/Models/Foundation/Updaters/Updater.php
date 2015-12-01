<?php

namespace App\Models\Foundation\Updaters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Updater
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract public function update();

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\Request            $request
     *
     * @return static
     */
    public static function create(Model $model, Request $request)
    {
        $updater = new static();

        $updater->model = $model;
        $updater->request = $request;

        return $updater;
    }
}
