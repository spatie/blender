<?php

Route::get('/', 'HomeController@index');

Route::get(article('contact')->url, 'ContactController@index');
Route::post(article('contact')->url, 'ContactController@handleResponse');

Route::post('newsletter/api/subscribe', 'NewsletterApiController@subscribe');
