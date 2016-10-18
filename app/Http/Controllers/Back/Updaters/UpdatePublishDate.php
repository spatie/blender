<?php

namespace App\Http\Controllers\Back\Updaters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

trait UpdatePublishDate
{
    protected function updatePublishDate(Model $model, FormRequest $request)
    {
        if (! $request->has('publish_date')) {
            return;
        }

        $model->publish_date = Carbon::createFromFormat('d/m/Y', $request->get('publish_date'));
    }
}
