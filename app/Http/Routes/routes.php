<?php

Route::demoAccess('/demo');

Route::group(['namespace' => 'Back', 'prefix' => 'blender'], function () {

    require __DIR__ . '/back_auth.php';

    Route::group(['middleware' => 'auth'], function () {
        require __DIR__ . '/back.php';
    });
});

Route::group(['namespace' => 'Front', 'middleware' => 'demoMode'], function () {

    $multiLingual = count(config('app.locales')) > 1;

    Route::group($multiLingual ? ['prefix' => locale()] : [], function () {
        try {
            require __DIR__ . '/front_auth.php';
            require __DIR__ . '/front.php';
        } catch (Exception $exception) {
            logger()->warning('Front routes weren\'t included.');
        }
    });

    if ($multiLingual) {
        Route::get('/', function () {
            return redirect(locale());
        });
    }
});
