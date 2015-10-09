<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Back\Traits\Orderable;
use App\Models\Tag;

class TagController extends ModuleController
{
    use Orderable;

    protected $modelName = 'Tag';
    protected $moduleName = 'tags';

    /**
     * Return a fresh instance of the model (called on `create()`).
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function make()
    {
        $model = new Tag();
        $model->save();

        return $model;
    }
}
