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


/**
 * Playlists
 */

get('/playlists', ['as' => 'playlists', 'uses' => 'Content\PlaylistController@index']);


/**
 * Scheduler
 */
get('/schedule', ['as' => 'schedule', 'uses' => 'Content\ScheduleController@index']);


/**
 * Content
 */

get('/files', ['as' => 'files', 'uses' => 'Content\FileController@index']);
post('/files/upload', ['as' => 'files.upload', 'uses' => 'Content\FileController@store']);

/**
 * Plugins
 */

get('/plugins', ['as' => 'plugins', 'uses' => 'Content\PluginController@index']);
put('/plugins/disable', ['as' => 'plugins.disable', 'uses' => 'Content\PluginController@disablePlugin']);
put('/plugins/enable', ['as' => 'plugins.enable', 'uses' => 'Content\PluginController@enablePlugin']);

/**
 * Outputs
 */

get('/outputs', ['as' => 'outputs', 'uses' => 'IO\E131Controller@index']);
get('/outputs/pixelnet', ['as' => 'outputs.pixelnet', 'uses' => 'IO\PixelnetController@index']);
get('/outputs/other', ['as' => 'outputs.other', 'uses' => 'IO\ChannelController@index']);
get('/outputs/remap', ['as' => 'outputs.remap', 'uses' => 'IO\ChannelController@remap']);


/**
 * Settings
 */

get('/settings',		 ['as' => 'settings', 		 		 'uses' => 'Settings\SettingsController@index']);
post('/settings',		 ['as' => 'settings.store', 	     'uses' => 'Settings\SettingsController@store']);

get('/settings/network', ['as' => 'settings.network', 		 'uses' => 'Settings\NetworkController@index']);
post('/settings/network',['as' => 'settings.network.store',  'uses' => 'Settings\NetworkController@store']);

get('/settings/network/dns', ['as' => 'settings.network.dns', 		 'uses' => 'Settings\NetworkController@dns']);
post('/settings/network/dns',['as' => 'settings.network.dns.store',  'uses' => 'Settings\NetworkController@storeDNS']);


get('/settings/logs',	 ['as' => 'settings.logs',    		 'uses' => 'Settings\LogsController@index']);
post('/settings/logs',	 ['as' => 'settings.logs.store',     'uses' => 'Settings\LogsController@store']);

get('/settings/email',	 ['as' => 'settings.email',   		 'uses' => 'Settings\EmailController@index']);
post('/settings/email',	 ['as' => 'settings.email.store',    'uses' => 'Settings\EmailController@store']);

get('/settings/date',	 ['as' => 'settings.date',   		 'uses' => 'Settings\DateTimeController@index']);
post('/settings/date',	 ['as' => 'settings.date.store',    'uses' => 'Settings\DateTimeController@store']);


/**
 * Models
 */

get('/models', ['as' => 'models', 'uses' => 'IO\ModelsController@index']);



/**
 * Testing
 */

get('/testing', ['as' => 'testing', 'uses' => 'Testing\OutputTestingController@index']);
get('/testing/sequence', ['as' => 'testing.sequence', 'uses' => 'Testing\SequenceTestingController@index']);





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
	get('/playlists/{playlist}', 'PlaylistController@getPlaylist');

	get('/schedule', 'ScheduleController@getSchedule');

	get('/files', 'MediaController@getAllFiles');
	get('/files/music', 'MediaController@getMusicFiles');
	get('/files/video', 'MediaController@getVideoFiles');
	get('/files/sequence', 'MediaController@getSequenceFiles');

	get('/universes', 'UniverseController@universes');
	get('/universes/{universe}', 'UniverseController@getUniverse');

	get('/settings', 'SettingController@getAllSettings');
	get('/settings/{setting}', 'SettingController@getSetting');
	put('/settings/{setting}', 'SettingController@update');

});



// Temporary
//Event::listen('status.request', function($data) {
//
//		return \BrainSocket::message('status.request',[ 'status' => 'test' ] );
//});


