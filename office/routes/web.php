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

Route::view('/dashboard', 'dashboard');

Route::prefix('/ships')->group(function () {
    Route::get('/', 'ShipController@index');
    Route::get('/create', 'ShipController@create');
    Route::post('/', 'ShipController@store');
});

Route::prefix('/concepts')->group(function () {
    Route::get('/', 'TrainingConceptController@index');
    Route::get('/create', 'TrainingConceptController@create');
    Route::post('/', 'TrainingConceptController@store');
});

Route::prefix('/trainings')->group(function () {
    Route::get('/', 'TrainingController@index');
    Route::get('/create', 'TrainingController@create');
    Route::get('/{training}', 'TrainingController@show');
    Route::post('/', 'TrainingController@store');
});
