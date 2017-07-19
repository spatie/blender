<?php

namespace App\Http\Controllers\Back\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait UpdateDates
{
    protected function updateDates(Model $model, Request $request)
    {
        foreach ($model->getDates() as $dateAttribute) {
            if ($request->has($dateAttribute)) {
                $model->$dateAttribute = Carbon::createFromFormat('d/m/Y', $request->get($dateAttribute));
            }
        }
    }
}
