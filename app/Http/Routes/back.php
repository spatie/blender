<?php

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('log', 'ActivitylogController@index');
Route::resource('fragment', 'FragmentController');

Route::post('fragment/download', 'FragmentController@download');
Route::get('formresponses', 'FormResponseController@showDownloadButton');
Route::post('formresponses', 'FormResponseController@download');

Route::get('statistics', 'StatisticsController@index')->name('statistics');

Route::module('backUsers', 'BackUser');

Route::module('articles', 'Article');
Route::module('newsItems', 'NewsItem');
Route::module('people', 'Person', true);
Route::module('tags', 'Tag', true);

Route::get('api/media', 'MediaLibraryApiController@index');
Route::post('api/media', 'MediaLibraryApiController@add');
