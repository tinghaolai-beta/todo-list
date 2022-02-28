<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'todoList'], function () {
    Route::get('/', 'TodoListController@getList');
    Route::get('/{id}', 'TodoListController@get')->where('id', '[0-9]+');
    Route::post('/', 'TodoListController@store');
    Route::put('/{id}', 'TodoListController@update')->where('id', '[0-9]+');
    Route::delete('/{id}', 'TodoListController@delete')->where('id', '[0-9]+');
});
