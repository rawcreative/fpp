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

get('/settings',		 ['as' => 'settings', 		 		 'uses' => 'Settings\SettingsController@index']);
post('/settings',		 ['as' => 'settings.store', 	     'uses' => 'Settings\SettingsController@store']);
get('/settings/network', ['as' => 'settings.network', 		 'uses' => 'Settings\SettingsController@showNetwork']);
post('/settings/network',['as' => 'settings.network.store',  'uses' => 'Settings\SettingsController@storeNetwork']);
get('/settings/logs',	 ['as' => 'settings.logs',    		 'uses' => 'Settings\SettingsController@showLogs']);
post('/settings/logs',	 ['as' => 'settings.logs.store',     'uses' => 'Settings\SettingsController@storeLogs']);
get('/settings/email',	 ['as' => 'settings.email',   		 'uses' => 'Settings\SettingsController@showEmail']);
post('/settings/email',	 ['as' => 'settings.email.store',    'uses' => 'Settings\SettingsController@storeEmail']);


/**
 * API
 *
 */

Route::group(['prefix' => 'api'], function() {

	get('/status', 'Api\v1\StatusController@index');

	get('/fppd/start', 'Api\v1\FPPDController@start');
	get('/fppd/stop', 'Api\v1\FPPDController@stop');
	get('/fppd/restart', 'Api\v1\FPPDController@restart');
	get('/fppd/mode', 'Api\v1\FPPDController@getMode');

	get('/playlists', 'Api\v1\PlaylistController@getPlaylists');
	get('/playlist/{playlist}', 'Api\v1\PlaylistController@getPlaylist');

});

Event::listen('status.request', function($data) {
		
		return \BrainSocket::message('status.request',[ 'status' => 'test' ] );
});


