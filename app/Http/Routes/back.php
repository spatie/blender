<?php

// Default
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('log', 'ActivitylogController@index');
Route::resource('fragment', 'FragmentController');
Route::post('fragment/download', 'FragmentController@download');
Route::get('formresponses/', 'FormResponseController@showDownloadButton');
Route::post('formresponses/', 'FormResponseController@download');
Route::get('statistics', 'StatisticsController@index')->name('statistics');

Route::pattern('role', App\Models\Enums\UserRole::allAsRegex());
Route::group(['prefix' => 'user'], function () {
    Route::get('', 'UserController@redirectToDefaultIndex');
    Route::get('activate/{user}', 'UserController@activate');
    Route::get('{role}', 'UserController@index');
    Route::get('{role}/create', 'UserController@create');
    Route::post('{role}/store', 'UserController@store');
});
Route::resource('user', 'UserController', ['except' => ['index', 'create', 'store']]);

// Standard modules
Route::module('articles', 'Article');
Route::module('newsItems', 'NewsItem');
Route::module('people', 'Person', true);
Route::module('tags', 'Tag', true);

// API
Route::get('api/media', 'MediaLibraryApiController@index');
Route::post('api/media', 'MediaLibraryApiController@add');
