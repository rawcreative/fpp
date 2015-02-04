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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/**
 * UI Routes
 */

Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);


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
 * API Routes
 *
 */

Route::group(['namespace' => 'Api\v1', 'prefix' => 'api'], function() {


	get('/fppd/start', 'FPPDController@start');
	get('/fppd/stop', 'FPPDController@stop');
	get('/fppd/restart', 'FPPDController@restart');
	get('/fppd/mode', 'FPPDController@getMode');
	get('/fppd/status', 'FPPDController@status');

	get('/playlists', 'PlaylistController@getPlaylists');
	get('/playlist/{playlist}', 'PlaylistController@getPlaylist');

	get('/schedule', 'ScheduleController@getSchedule');

	get('/files', 'MediaController@getAllFiles');
	get('/files/music', 'MediaController@getMusicFiles');
	get('/files/video', 'MediaController@getVideoFiles');
	get('/files/sequence', 'MediaController@getSequenceFiles');

	get('/universes', 'UniverseController@universes');
	get('/universe/{universe}', 'UniverseController@getUniverse');

});

// Temporary
Event::listen('status.request', function($data) {
		
		return \BrainSocket::message('status.request',[ 'status' => 'test' ] );
});


