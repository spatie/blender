<?php

namespace App\Services\Html;

use Collective\Html\HtmlServiceProvider as ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Html::class);
    }
}
