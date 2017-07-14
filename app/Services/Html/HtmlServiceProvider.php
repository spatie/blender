<?php

namespace App\Services\Html;

use Spatie\Html\Html as BaseHtml;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(BaseHtml::class, Html::class);
    }
}
