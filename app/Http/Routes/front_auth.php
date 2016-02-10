<?php

Route::group(['middleware' => 'guest'], function () {

    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');

    Route::get('password/email', 'AuthController@getEmail');
    Route::post('password/email', 'AuthController@postEmail');
    Route::get('password/reset/{token}', 'AuthController@getReset');
    Route::post('password/reset/{token}', 'AuthController@postReset');

    Route::get('password', function () {
        return redirect()->action('AuthController@getEmail');
    });
});

Route::get('logout', 'AuthController@getLogout');

Route::get('register', 'AuthController@getRegister');
Route::post('register', 'AuthController@postRegister');
