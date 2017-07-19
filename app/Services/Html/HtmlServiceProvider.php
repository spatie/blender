<?php

namespace App\Services\Html;

use Illuminate\Support\ServiceProvider;
use Spatie\Html\Html as BaseHtml;

class HtmlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(BaseHtml::class, Html::class);
    }
}
