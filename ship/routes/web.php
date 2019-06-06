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

Route::redirect('/', '/dashboard');

Route::get('/dashboard', 'Controller@dashboard');

Route::get('/sync', 'CommunicationController@sync');

Route::prefix('/operating-hours')->group(function () {
    Route::get ('/'      , 'OperatingHoursController@index' );
    Route::get ('/create', 'OperatingHoursController@create');
    Route::post('/'      , 'OperatingHoursController@store' );
});

Route::prefix('/trainings')->group(function () {
    Route::get ('/'                   , 'TrainingController@index'       );
    Route::get ('/{training}'         , 'TrainingController@show'        );
    Route::get ('/{training}/complete', 'TrainingController@showComplete');
    Route::post('/{training}/complete', 'TrainingController@complete'    );
});
