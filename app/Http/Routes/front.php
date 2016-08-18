<?php

use App\Http\Routes\Route as RouteName;

Route::get('meta', function () {
    $item = App\Models\NewsItem::first();

    dd(
        $item->meta(),
        $item->meta('title'),
        (string) $item->meta()
    );
});

Route::get('/', 'HomeController@index')->name(RouteName::HOME);

Route::get(article('contact')->url, 'ContactController@index')->name(RouteName::CONTACT);
Route::post(article('contact')->url, 'ContactController@handleResponse');

Route::post('newsletter/api/subscribe', 'NewsletterApiController@subscribe');

Route::get('{articleUrl}/{subArticleUrl}', 'ArticleController@index');
Route::get('{articleUrl}', 'ArticleController@index');
