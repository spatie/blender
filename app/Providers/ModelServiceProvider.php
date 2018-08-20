<?php

namespace App\Providers;

use App\Models\Scopes\NonDraftMediaScope;
use App\Models\Scopes\SortableScope;
use Illuminate\Support\ServiceProvider;
use Spatie\MediaLibrary\Models\Media;

class ModelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Media::addGlobalScope(new NonDraftMediaScope());
        Media::addGlobalScope(new SortableScope());
    }
}
