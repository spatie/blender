<?php

namespace App\Providers;

use Auth;
use Route;
use Exception;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = \App\Http\Controllers::class;

    public function boot()
    {
        $this->registerMacros(app(\Illuminate\Routing\Router::class));

        parent::boot();
    }

    protected function registerMacros(Router $router)
    {
        $router->macro('module', function ($module, $sortable = false) use ($router) {
            $controller = ucfirst($module).'Controller';
            if ($sortable) {
                $router->patch("{$module}/changeOrder", $controller.'@changeOrder');
            }

            $router->resource($module, $controller);
        });

        $this->app['paginateroute']->registerMacros();
    }

    public function map(Router $router)
    {
        Route::namespace($this->namespace)->group(function () {

            /*
             * Special routes
             */
            Route::middleware('web')->group(function () {
                Route::demoAccess('/demo');

                Route::get('coming-soon', function () {
                    return view('temp/index');
                });
            });

            /*
             * Back site
             */
            Route::group(['namespace' => 'Back', 'middleware' => 'web', 'prefix' => 'blender'], function () {
                Auth::routes();

                Route::group(['middleware' => 'auth'], function () {
                    require base_path('routes/back.php');
                });
            });

            /*
             * Frontsite
             */

            Route::group(['namespace' => 'Front'], function () {
                Route::group(['namespace' => 'Api', 'middleware' => 'api', 'prefix' => 'api'], function () {
                    require base_path('routes/frontApi.php');
                });

                Route::group(['middleware' => ['web', 'demoMode', 'rememberLocale']], function () {
                    $multiLingual = count(config('app.locales')) > 1;

                    Route::group($multiLingual ? ['prefix' => locale()] : [], function () {
                        try {
                            Auth::routes();
                            require base_path('routes/front.php');
                        } catch (Exception $exception) {
                            logger()->warning("Front routes weren't included because {$exception->getMessage()}.");
                        }
                    });

                    if ($multiLingual) {
                        Route::get('/', function () {
                            return redirect(locale());
                        });
                    }
                });
            });
        });
    }
}
