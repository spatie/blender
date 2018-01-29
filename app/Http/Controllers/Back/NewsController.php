<?php

namespace App\Http\Controllers\Back;

use App\Models\NewsItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $modelName = 'NewsItem';

    protected function make(): NewsItem
    {
        return NewsItem::create([
            'publish_date' => Carbon::now(),
        ]);
    }

    protected function updateFromRequest(NewsItem $model, Request $request)
    {
        $this->updateModel($model, $request);
        $this->updateTags($model, $request);
    }

    protected function validationRules(): array
    {
        $rules = [
            'publish_date' => 'date_format:d/m/Y',
        ];

        foreach (config('app.locales') as $locale) {
            $rules[translate_field_name('name', $locale)] = 'required';
            $rules[translate_field_name('text', $locale)] = 'required';
        }

        return $rules;
    }
}
