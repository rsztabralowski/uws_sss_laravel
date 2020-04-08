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
Route::get('/users', 'AccountController@users')->middleware('admin')->name('users');
Route::get('/users/delete/{id}', 'UserController@delete')->middleware('admin')->name('users.delete');
Route::get('/users/restore/{id}', 'UserController@restore')->middleware('admin')->name('users.restore');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');