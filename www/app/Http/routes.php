<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DashboardController@index');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/**
 * API
 *
 */

Route::group(['prefix' => 'api'], function() {

	get('/status', 'Api\v1\StatusController@index');

});

Event::listen('status.request', function($data) {
		

		return \BrainSocket::message('status.request',[ 'status' => 'test' ] );
});

