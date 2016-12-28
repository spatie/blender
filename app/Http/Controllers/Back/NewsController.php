<?php

namespace App\Http\Controllers\Back;

use Carbon\Carbon;
use App\Models\NewsItem;
use Spatie\Blender\Model\Controller;
use App\Http\Requests\Back\NewsItemRequest;

class NewsController extends Controller
{
    protected function make(): NewsItem
    {
        return NewsItem::create([
            'publish_date' => Carbon::now(),
        ]);
    }

    protected function updateFromRequest(NewsItem $model, NewsItemRequest $request)
    {
        $this->updateModel($model, $request);
        $this->updateTags($model, $request);
    }
}
