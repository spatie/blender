<?php

Route::name('dashboard')->get('/', 'DashboardController@index');
Route::get('log', 'ActivitylogController@index');

Route::resource('fragments', 'FragmentsController', ['except' => 'show']);

Route::get('formresponses', 'FormResponsesController@showDownloadButton');
Route::post('formresponses', 'FormResponsesController@download');

Route::name('statistics')->get('statistics', 'StatisticsController@index');

Route::module('administrators');
Route::module('members');

Route::module('articles', true);
Route::module('news');
Route::module('people', true);
Route::module('tags', true);
Route::module('redirects', true);
Route::module('recipients');

Route::prefix('api')->group(function () {
    Route::get('media', 'Api\MediaLibraryController@index');
    Route::post('media', 'Api\MediaLibraryController@add');

    Route::post('contentblocks', 'Api\ContentBlockController@add');
});
