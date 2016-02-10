<?php

Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@getLogout');

Route::get('password/email', 'AuthController@getEmail');
Route::post('password/email', 'AuthController@postEmail');
Route::get('password/reset/{token}', 'AuthController@getReset');
Route::post('password/reset/{token}', 'AuthController@postReset');
Route::redirect('password', 'AuthController@getEmail');
