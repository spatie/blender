<?php

use App\Models\Enums\SpecialArticle;

Route::get('/', 'HomeController@index')->name('home');

Route::get(article(SpecialArticle::CONTACT)->slug, 'ContactController@index')->name('contact');
Route::post(article(SpecialArticle::CONTACT)->slug, 'ContactController@handleResponse')->middleware('logRequest');

Route::get('{articleUrl}/{subArticleUrl}', 'ArticleController@index');
Route::get('{articleUrl}', 'ArticleController@index');
