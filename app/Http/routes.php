<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Controller@index');

Route::resource('candle', 'CandleController');
Route::resource('instrument', 'InstrumentController');
Route::get('/instrument/{id}/update', 'InstrumentController@update');
Route::get('/instrument/{id}/fann', 'InstrumentController@fann');