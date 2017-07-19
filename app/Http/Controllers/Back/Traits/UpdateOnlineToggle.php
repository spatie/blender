<?php

namespace App\Http\Controllers\Back\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait UpdateOnlineToggle
{
    protected function updateOnlineToggle(Model $model, Request $request)
    {
        $model->online = $request->get('online') ?? false;
    }
}
