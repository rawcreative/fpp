<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'status', 'uses' => 'FPP\Http\Controllers\DashboardController@index']);

Route::api('v1', function () {

    Route::get('/status', 'FPP\Http\Controllers\Api\v1\StatusController@index');

});
