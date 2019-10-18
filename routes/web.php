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

Auth::routes(['reset' => false]);
Route::get('/', 'IndexController@index')->name('index');
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/edit', 'UserController@edit')->name('users.edit');
Route::put('/users', 'UserController@update')->name('users.update');
Route::delete('/users', 'UserController@destroy')->name('users.destroy');
Route::resource('/task_statuses', 'TaskStatusController')->except('show');
Route::resource('/tasks', 'TaskController');