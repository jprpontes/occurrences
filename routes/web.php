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
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::group(['as' => 'sectors.', 'prefix' => 'sectors'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'SectorController@index']);
    });

    Route::group(['as' => 'steps.', 'prefix' => 'steps'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'StepController@index']);
    });

    Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
        Route::get('/pagination', ['as' => 'pagination', 'uses' => 'UserController@pagination']);
        Route::get('/create', ['as' => 'create', 'uses' => 'UserController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'UserController@edit']);
        Route::post('/', ['as' => 'store', 'uses' => 'UserController@store']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
    });
});
