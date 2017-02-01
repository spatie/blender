<?php

use App\Models\Enums\SpecialArticle;

Route::name('home')->get('/', 'HomeController@index');

Route::name('contact')->get(article(SpecialArticle::CONTACT)->url, 'ContactController@index');
Route::post(article(SpecialArticle::CONTACT)->url, 'ContactController@handleResponse');

Route::get('{articleUrl}/{subArticleUrl}', 'ArticleController@index');
Route::get('{articleUrl}', 'ArticleController@index');
