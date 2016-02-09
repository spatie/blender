<?php

namespace App\Http\Controllers\Back;

use App\Models\NewsItem;
use Carbon\Carbon;

class NewsItemController extends ModuleController
{
    protected $modelName = 'NewsItem';
    protected $moduleName = 'newsItems';

    protected function make()
    {
        $model = new NewsItem();
        $model->publish_date = new Carbon();
        $model->save();

        return $model;
    }
}
