<?php

namespace App\Http\Controllers\Back;

use App\Models\NewsItem;
use Carbon\Carbon;

class NewsItemController extends ModuleController
{
    protected $modelName = 'NewsItem';
    protected $moduleName = 'newsItems';

    /**
     * Return a fresh instance of the model (called on `create()`).
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function make()
    {
        $model = new NewsItem();
        $model->publish_date = new Carbon();
        $model->save();

        return $model;
    }
}
