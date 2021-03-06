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
Route::get('/widget', 'WidgetController@index');
Route::get('/branch', 'WidgetController@getBranch');
Route::get('/specialties', 'WidgetController@getSpecialties');
Route::get('/datatime', 'WidgetController@getDataTime');
Route::get('/worker', 'WidgetController@getWorker');
