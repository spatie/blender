<?php

use App\Http\Routes\Route as RouteName;

// Site

Route::get('/', 'HomeController@index')->name(RouteName::HOME);

Route::get(article('contact')->url, 'ContactController@index')->name(RouteName::CONTACT);
Route::post(article('contact')->url, 'ContactController@handleResponse');

// API

Route::post('newsletter/api/subscribe', 'NewsletterApiController@subscribe');

// Auth

Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@getLogout');

Route::get('password/email', 'AuthController@getEmail');
Route::post('password/email', 'AuthController@postEmail');
Route::get('password/reset/{token}', 'AuthController@getReset');
Route::post('password/reset/{token}', 'AuthController@postReset');
Route::redirect('password', 'AuthController@getEmail');
