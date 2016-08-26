<?php

Route::group(['middleware' => ['web']], function() {

    Route::demoAccess('/demo');

    Route::get('coming-soon', function () {
        return view('temp/index');
    });



    Route::group(['namespace' => 'Back', 'prefix' => 'blender'], function () {

        Auth::routes();

        Route::group(['middleware' => 'auth'], function () {
            require __DIR__.'/back.php';
        });
    });

    Route::group(['namespace' => 'Front', 'middleware' => ['demoMode', 'rememberLocale']], function () {

        $multiLingual = count(config('app.locales')) > 1;

        Route::group($multiLingual ? ['prefix' => locale()] : [], function () {
            try {
                Auth::routes();
                require __DIR__.'/front.php';
            } catch (Exception $exception) {
                logger()->warning("Front routes weren't included.");
            }
        });

        if ($multiLingual) {
            Route::get('/', function () {
                return redirect(locale());
            });
        }
    });
});


