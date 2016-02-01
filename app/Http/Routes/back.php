<?php

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('log', 'ActivitylogController@index');
Route::resource('fragment', 'FragmentController');
Route::get('formresponses', 'FormResponseController@showDownloadButton');
Route::post('formresponses', 'FormResponseController@download');
Route::get('statistics', 'StatisticsController@index')->name('statistics');

Route::pattern('role', App\Models\Enums\UserRole::allAsRegex());
Route::get('user', 'UserController@redirectToDefaultIndex');
Route::get('user/activate/{user}', 'UserController@activate');
Route::get('user/{role}', 'UserController@index');
Route::get('user/{role}/create', 'UserController@create');
Route::post('user/{role}/store', 'UserController@store');
Route::resource('user', 'UserController', ['except' => ['index', 'create', 'store']]);

Route::module('articles', 'Article');
Route::module('newsItems', 'NewsItem');
Route::module('people', 'Person', true);
Route::module('tags', 'Tag', true);

Route::get('api/media', 'MediaLibraryApiController@index');
Route::post('api/media', 'MediaLibraryApiController@add');
