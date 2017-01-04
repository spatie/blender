<?php

use App\Models\Enums\SpecialArticle;

Route::get('/', 'HomeController@index')->name('home');

Route::get(article(SpecialArticle::CONTACT)->url, 'ContactController@index')->name('contact');
Route::post(article(SpecialArticle::CONTACT)->url, 'ContactController@handleResponse');

Route::get('{articleUrl}/{subArticleUrl}', 'ArticleController@index');
Route::get('{articleUrl}', 'ArticleController@index');
