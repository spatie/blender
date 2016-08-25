<?php

namespace App\Providers;

use App\Models\Article;
use App\Services\Locale\CurrentLocale;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        $this->app->setLocale(CurrentLocale::determine());

        $this->registerMacros(app(\Illuminate\Routing\Router::class));

        parent::boot();
    }

    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function () {
            require base_path('routes/routes.php');
        });
    }

    protected function registerMacros(Router $router)
    {
        $router->macro('module', function ($slug, $className, $sortable = false) use ($router) {
            if ($sortable) {
                $router->patch("{$slug}/changeOrder", "{$className}Controller@changeOrder");
            }

            $router->resource($slug, "{$className}Controller");
        });

        $router->macro('articleList', function ($technicalNamePrefix, $action) use ($router) {

            $articles = Article::getWithTechnicalNameLike($technicalNamePrefix);

            $router->get(app()->getLocale().'/'.fragment_slug("navigation.{$technicalNamePrefix}"), function () use ($articles) {
                return redirect(route("{$articles->first()->technical_name}"));
            })->name($technicalNamePrefix);

            $articles->map(function ($article) use ($technicalNamePrefix, $action, $router) {
                $router->get(app()->getLocale().'/'.fragment_slug("navigation.{$technicalNamePrefix}").'/'.$article->url, $action)->name("{$article->technical_name}");
            });
        });

        $this->app['paginateroute']->registerMacros();
    }
}
