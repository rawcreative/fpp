<?php

return [

    /*
	|--------------------------------------------------------------------------
	| FPP Debug Mode
	|--------------------------------------------------------------------------
	|
	|
	*/
    'debug'     => false,
    /*
    |--------------------------------------------------------------------------
    | FPP Setting Directory
    |--------------------------------------------------------------------------
    |
    |
    */
    'settings'  => [
        'settings_file' => '/home/pi/media/settings',
        'defaults'      => [
            'fppdMode'               => 'player',
            'alwaysTransmit'         => false,
            'PiFaceDetected'         => false,
            'FalconHardwareDetected' => false,
            'restartFlag'            => false,
            'E131Enabled'            => true,
            'rebootFlag'             => false,

        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | FPP Media Directories & files
    |--------------------------------------------------------------------------
    |
    |
    */
    'media'     => '/home/pi/media',
    'music'     => '/home/pi/media/music',
    'sequences' => '/home/pi/media/sequences',
    'playlists' => '/home/pi/media/playlists',
    'events'    => '/home/pi/media/events',
    'videos'    => '/home/pi/media/videos',
    'effects'   => '/home/pi/media/effects',
    'scripts'   => '/home/pi/media/scripts',
    'logs'      => '/home/pi/media/logs',
    'upload'    => '/home/pi/media/upload',
    'universes' => '/home/pi/media/universes',
    'pixelnet'  => '/home/pi/media/pixelnetDMX',
    'schedule'  => '/home/pi/media/schedule',
    'bytes'     => '/home/pi/media/bytesReceived',
    'remap'     => '/home/pi/media/channelremap',
    'exim'      => '/home/pi/media/exim4',
    'docs'      => fpp_dir() . '/docs',
    /*
    |--------------------------------------------------------------------------
    | FPP Email Settings
    |--------------------------------------------------------------------------
    |
    |
    */
    'email'     => [

        'enable'   => false,
        'username' => '',
        'password' => '',
        'from'     => '',
        'to'       => '',
    ],

];