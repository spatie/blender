<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use Carbon\Carbon;

class ArticleController extends ModuleController
{
    protected $modelName = 'Article';
    protected $moduleName = 'articles';

    /**
     * Return a fresh instance of the model (called on `create()`).
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function make()
    {
        $model = new Article();
        $model->publish_date = new Carbon();
        $model->save();

        return $model;
    }
}
