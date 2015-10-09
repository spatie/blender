<?php

Route::get('auth/login', ['uses' => 'AuthController@getLogin', 'as' => 'login']);
Route::post('auth/login', 'AuthController@postLogin');
Route::get('auth/logout', ['uses' => 'AuthController@getLogout', 'as' => 'logout']);

Route::get('auth', function () {
    return redirect('/nl/auth/login');
});

Route::get('password/email', 'PasswordController@getEmail');
Route::post('password/email', 'PasswordController@postEmail');
Route::get('password/reset/{token}', 'PasswordController@getReset');
Route::post('password/reset/{token}', 'PasswordController@postReset');

Route::get('password', function () {
    return redirect()->action('PasswordController@getEmail');
});

Route::pattern('registrationRole', '(member)');
Route::group(['prefix' => 'register'], function () {
    Route::get('{registrationRole}', 'RegistrationController@showRegistrationForm');
    Route::post('{registrationRole}', 'RegistrationController@saveUser');
});
