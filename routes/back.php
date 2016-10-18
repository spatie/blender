<?php

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('log', 'ActivitylogController@index');

Route::resource('fragments', 'FragmentsController', ['except' => 'show']);
Route::get('fragments/hidden', 'FragmentsController@hidden');
Route::post('fragments/download', 'FragmentsController@download');

Route::get('formresponses', 'FormResponsesController@showDownloadButton');
Route::post('formresponses', 'FormResponsesController@download');

Route::get('statistics', 'StatisticsController@index')->name('statistics');

Route::module('administrators');
Route::module('members');

Route::module('articles', true);
Route::module('news');
Route::module('people', true);
Route::module('tags', true);
Route::module('redirects', true);

Route::get('api/media', 'Api\MediaLibraryController@index');
Route::post('api/media', 'Api\MediaLibraryController@add');
