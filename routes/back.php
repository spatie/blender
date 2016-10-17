<?php

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('log', 'ActivitylogController@index');
Route::resource('fragments', 'FragmentController', ['except' => 'show']);

Route::get('fragments/hidden', 'FragmentController@hidden');
Route::post('fragments/download', 'FragmentController@download');

Route::get('formresponses', 'FormResponseController@showDownloadButton');
Route::post('formresponses', 'FormResponseController@download');

Route::get('statistics', 'StatisticsController@index')->name('statistics');

Route::module('administrators', 'BackUser');
Route::module('members', 'FrontUser');

Route::module('articles', 'Article', true);
Route::module('news', 'News');
Route::module('people', 'Person', true);
Route::module('tags', 'Tag', true);
Route::module('redirects', 'Redirect', true);

Route::get('api/media', 'MediaLibraryApiController@index');
Route::post('api/media', 'MediaLibraryApiController@add');
