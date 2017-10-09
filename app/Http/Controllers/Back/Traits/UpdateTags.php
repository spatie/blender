<?php

namespace App\Http\Controllers\Back\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait UpdateTags
{
    public function updateTags(Model $model, Request $request)
    {
        $model->tags()->detach();

        foreach ($model->tagTypes as $type) {
            collect($request->get("{$type}_tags"))->each(function ($name) use ($model, $type) {
                if (! empty($name)) {
                    $tag = Tag::findOrCreate($name, $type);

                    $model->tags()->attach($tag);
                }
            });
        }
    }
}
