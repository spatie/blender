<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get(article('contact')->url, 'ContactController@index')->name('contact');
Route::post(article('contact')->url, 'ContactController@handleResponse');

Route::post('newsletter/api/subscribe', 'NewsletterApiController@subscribe');

Route::get('{articleUrl}/{subArticleUrl}', 'ArticleController@index');
Route::get('{articleUrl}', 'ArticleController@index');
