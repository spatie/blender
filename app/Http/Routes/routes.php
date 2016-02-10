<?php

Route::group(['namespace' => 'Back', 'prefix' => 'blender'], function () {

    Route::group(['middleware' => 'auth'], function () {
        require __DIR__.'/back.php';
    });

    require __DIR__.'/back_auth.php';
});

Route::group(['namespace' => 'Front'], function () {

        $multiLingual = count(config('app.locales')) > 1;

        Route::group($multiLingual ? ['prefix' => locale()] : [], function () {
            try {
                require __DIR__.'/front.php';
                require __DIR__.'/front_auth.php';
            } catch (Exception $exception) {
                logger()->warning('Front routes weren\'t included.');
            }
        });

        if ($multiLingual) {
            Route::get('/', function () {
                return redirect(locale());
            });
        }
    }
);
