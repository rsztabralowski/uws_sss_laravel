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

Auth::routes();
Route::resource('facts', 'FactController');

Route::get('/', 'FactController@index')->name('main');
Route::get('/account', 'AccountController@index')->name('account');
Route::get('/all', 'AccountController@all')->middleware('admin')->name('all');
