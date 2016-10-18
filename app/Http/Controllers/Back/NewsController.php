<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\NewsItemRequest;
use App\Models\NewsItem;
use Carbon\Carbon;
use Spatie\Blender\Model\Controller;

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
