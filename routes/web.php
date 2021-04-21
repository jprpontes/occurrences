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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', ['as' => 'home',    'uses' => 'HomeController@index']);

    Route::group(['as' => 'sectors.', 'prefix' => 'sectors'], function () {
        Route::get('/', ['as' => 'index',    'uses' => 'SectorController@index']);
    });

    Route::group(['as' => 'steps.', 'prefix' => 'steps'], function () {
        Route::get('/', ['as' => 'index',    'uses' => 'StepController@index']);
    });
});
