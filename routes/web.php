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

Route::get('/', 'PertanyaanController@index')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->get('/pertanyaan', 'PertanyaanController@index');
Route::middleware('auth')->get('/pertanyaan/create', 'PertanyaanController@create');
Route::middleware('auth')->post('/pertanyaan', 'PertanyaanController@store');
Route::middleware('auth')->get('/pertanyaan/{id}', 'PertanyaanController@show');
Route::middleware('auth')->get('/pertanyaan/{id}/edit', 'PertanyaanController@edit');
Route::middleware('auth')->put('/pertanyaan/{id}', 'PertanyaanController@update');
Route::middleware('auth')->delete('/pertanyaan/{id}', 'PertanyaanController@destroy');

Route::middleware('auth')->post('/pertanyaan/{pertanyaan_id}', 'JawabanController@store');
Route::middleware('auth')->get('/pertanyaan/{pertanyaan_id}', 'JawabanController@show');