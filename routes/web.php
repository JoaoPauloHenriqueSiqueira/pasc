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


Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    Route::post('/debt_configs', 'DebtConfigsController@save');
    Route::get('/', 'DebtConfigsController@index')->name('home');
    Route::post('/getDebts', 'DebtsController@get');
});
