<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appthis/report', 'AppThisController@report');
Route::get('/appthis/publisher/stats', 'AppThisController@getPublisherStats');
Route::get('/appthis/conversion/daily', 'AppThisController@getStatsByDay');
Route::get('/appthis/conversion/performance', 'AppThisController@getPerformanceData');
Route::get('/appthis/conversion/get-countries', 'AppThisController@getCountries');
Route::get('/appthis/publisher/get', 'AppThisController@getPublishers');
Route::get('/appthis/generate-impressions', 'AppThisController@generateImpressions');
Route::get('/appthis/algorithm', 'AppThisController@runAlgorithm');
