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

get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

get('/schedule', ['as' => 'schedule', 'uses' => 'Content\ScheduleController@index']);


/**
 * Outputs
 */

get('/outputs', ['as' => 'outputs', 'uses' => 'IO\E131Controller@index']);
get('/outputs/pixelnet', ['as' => 'outputs.pixelnet', 'uses' => 'IO\PixelnetController@index']);
get('/outputs/other', ['as' => 'outputs.other', 'uses' => 'IO\ChannelController@index']);


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
get('/settings/date',	 ['as' => 'settings.date',   		 'uses' => 'Settings\SettingsController@showDate']);
post('/settings/date',	 ['as' => 'settings.date.store',    'uses' => 'Settings\SettingsController@storeDate']);


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
	get('/fppd/fstatus', 'FPPDController@fstatus');

	get('/playlists', 'PlaylistController@getPlaylists');
	get('/playlist/{playlist}', 'PlaylistController@getPlaylist');

	get('/schedule', 'ScheduleController@getSchedule');

	get('/files', 'MediaController@getAllFiles');
	get('/files/music', 'MediaController@getMusicFiles');
	get('/files/video', 'MediaController@getVideoFiles');
	get('/files/sequence', 'MediaController@getSequenceFiles');

	get('/universes', 'UniverseController@universes');
	get('/universe/{universe}', 'UniverseController@getUniverse');

	get('/settings', 'SettingController@getAllSettings');
	get('/setting/{setting}', 'SettingController@getSetting');
	put('/setting/{setting}', 'SettingController@update');

});

// Temporary
Event::listen('status.request', function($data) {
		
		return \BrainSocket::message('status.request',[ 'status' => 'test' ] );
});


