<?php

namespace App\Providers;

use Spatie\MediaLibrary\Media;
use Illuminate\Support\ServiceProvider;
use App\Models\Scopes\SortableScope;
use App\Models\Scopes\NonDraftMediaScope;

class ModelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Media::addGlobalScope(new NonDraftMediaScope());
        Media::addGlobalScope(new SortableScope());
    }
}
