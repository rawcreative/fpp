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

Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/**
 * Settings
 */

get('/settings',		['as' => 'settings', 		 'uses' => 'Settings\SettingsController@index']);
get('/settings/network',['as' => 'settings.network', 'uses' => 'Settings\SettingsController@showNetwork']);
get('/settings/logs',	['as' => 'settings.logs',    'uses' => 'Settings\SettingsController@showLogs']);
get('/settings/email',	['as' => 'settings.email',   'uses' => 'Settings\SettingsController@showEmail']);


/**
 * API
 *
 */

Route::group(['prefix' => 'api'], function() {

	get('/status', 'Api\v1\StatusController@index');

	get('/fppd/start', 'Api\v1\FPPDController@start');
	get('/fppd/stop', 'Api\v1\FPPDController@stop');
	get('/fppd/restart', 'Api\v1\FPPDController@restart');

});

Event::listen('status.request', function($data) {
		
		return \BrainSocket::message('status.request',[ 'status' => 'test' ] );
});


