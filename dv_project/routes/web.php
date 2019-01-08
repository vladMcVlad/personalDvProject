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
})->name('home');

Route::get('/Playground', 'FileReaderController@GetAllAmericanRecordsAndRedirectToPlayground')->name('playground');

Route::get('/USRecords', 'FileReaderController@GetAllAmericanRecordsAndDisplayThemOnMap')->name('allUs');

Route::get('/GeoDistribution', 'FileReaderController@GetNumbersOfSightsPerCountryAndState')->name('geoDistribution');

Route::get('/TimeDistribution', 'FileReaderController@GetTimeDistributionData')->name('timeDistribution');

Route::get('/AllRecords', 'FileReaderController@DisplayAllRecords')->name('allRecordsTable');

Route::get('/DensityVsArea', 'FileReaderController@GetNumberOfSightsAndInfoPerUSState')->name('densityVsArea');

Route::get('/Test', 'FileReaderController@GetNumberOfSightsAndInfoPerUSState')->name('allRecordsTableeee');


