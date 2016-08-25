<?php

Route::group(['middleware' => 'guest'], function () {

    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');

    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');
    Route::get('password/reset/{token}', 'PasswordController@getReset');
    Route::post('password/reset/{token}', 'PasswordController@postReset');

    Route::get('password', function () {
        return redirect()->action('PasswordController@getEmail');
    });
});

Route::get('logout', 'AuthController@getLogout');

Route::get('register', 'AuthController@getRegister');
Route::post('register', 'AuthController@postRegister');
