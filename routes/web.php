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
    Route::get('/home', ['as' => 'home', 'uses' => 'WorkspaceController@index']);

    Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
        Route::get('/getusers', ['as' => 'getusers', 'uses' => 'UserController@getUsers']);
        Route::get('/create', ['as' => 'create', 'uses' => 'UserController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'UserController@edit']);
        Route::post('/', ['as' => 'store', 'uses' => 'UserController@store']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
    });

    Route::group(['as' => 'sectors.', 'prefix' => 'sectors'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'SectorController@index']);
        Route::get('/getsectors', ['as' => 'getsectors', 'uses' => 'SectorController@getSectors']);
        Route::get('/create', ['as' => 'create', 'uses' => 'SectorController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'SectorController@edit']);
        Route::post('/', ['as' => 'store', 'uses' => 'SectorController@store']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'SectorController@update']);
    });

    Route::group(['as' => 'activities.', 'prefix' => 'activities'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ActivityController@index']);
        Route::get('/getactivities', ['as' => 'getactivities', 'uses' => 'ActivityController@getActivities']);
        Route::get('/create', ['as' => 'create', 'uses' => 'ActivityController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ActivityController@edit']);
        Route::post('/', ['as' => 'store', 'uses' => 'ActivityController@store']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'ActivityController@update']);
    });

    Route::group(['as' => 'steps.', 'prefix' => 'steps'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'StepController@index']);
        Route::get('/getsteps', ['as' => 'getsteps', 'uses' => 'StepController@getSteps']);
        Route::get('/create', ['as' => 'create', 'uses' => 'StepController@create']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'StepController@edit']);
        Route::post('/', ['as' => 'store', 'uses' => 'StepController@store']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'StepController@update']);
        Route::get('/getstepstoprevnext', ['as' => 'getstepstoprevnext', 'uses' => 'StepController@getStepsToPrevNext']);
    });

    Route::group(['as' => 'usersteps.', 'prefix' => 'usersteps'], function () {
        Route::get('/getusers', ['as' => 'getusers', 'uses' => 'UserStepController@getUsers']);
    });

    Route::group(['as' => 'workspaces.', 'prefix' => 'workspaces'], function () {
        Route::get('/getsteps', ['as' => 'getsteps', 'uses' => 'WorkspaceController@getsteps']);
        Route::get('/getoccurrences', ['as' => 'getoccurrences', 'uses' => 'WorkspaceController@getOccurrences']);
        Route::get('/getstepsoptions', ['as' => 'getstepsoptions', 'uses' => 'WorkspaceController@getStepsOptions']);
    });

    Route::group(['as' => 'tasks.', 'prefix' => 'tasks'], function () {
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'TaskController@edit']);
        Route::post('/', ['as' => 'store', 'uses' => 'TaskController@store']);
        Route::put('/{id}', ['as' => 'update', 'uses' => 'TaskController@update']);
        Route::get('/getactivities', ['as' => 'getactivities', 'uses' => 'TaskController@getActivities']);
        Route::get('/getusers', ['as' => 'getusers', 'uses' => 'TaskController@getUsers']);
    });

    Route::group(['as' => 'occurrences.', 'prefix' => 'occurrences'], function () {
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'OccurrenceController@edit']);
        Route::post('/{id}/toassume', ['as' => 'toassume', 'uses' => 'OccurrenceController@toAssume']);
        Route::get('/getusers', ['as' => 'getusers', 'uses' => 'OccurrenceController@getUsers']);
        Route::put('/{id}/nextstep', ['as' => 'nextstep', 'uses' => 'OccurrenceController@nextStep']);
        Route::put('/{id}/changestep', ['as' => 'changestep', 'uses' => 'OccurrenceController@changeStep']);
        Route::put('/{id}/changeresponsible', ['as' => 'changeresponsible', 'uses' => 'OccurrenceController@changeResponsible']);
        Route::put('/{id}/changeexpectation', ['as' => 'changeexpectation', 'uses' => 'OccurrenceController@changeExpectation']);
        Route::get('/{id}/timeline', ['as' => 'timeline', 'uses' => 'OccurrenceController@timeline']);
    });
});
