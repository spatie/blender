<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use Carbon\Carbon;

class ArticleController extends ModuleController
{
    protected $modelName = 'Article';
    protected $moduleName = 'articles';

    protected function make()
    {
        $model = new Article();
        $model->publish_date = new Carbon();
        $model->save();

        return $model;
    }
}
