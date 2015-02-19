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
            'restartFlag'            => false,
            'screensaver'            => false,
            'forceLocalAudio'        => false,
            'E131Bridging'           => false,
            'emailenable'            => false,
            'piRTC'                  => 'N',

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

    'plugins' => [
    /*
   |--------------------------------------------------------------------------
   | Plugins Paths
   |--------------------------------------------------------------------------
   |
   | Here are the default plugin paths for the application. If the
   | same plugin (determined by the plugin's slug) is found in multiple
   | paths, the later plugin will be used. Order is important.
   |
   */

        'paths' => array(
            __DIR__.'/../plugins',
            __DIR__.'/../workbench',
        ),

        /*
        |--------------------------------------------------------------------------
        | Auto Register
        |--------------------------------------------------------------------------
        |
        | Here you may specify if the plugins are registered when the service
        | provider is booted. This will locate all plugins and register them.
        |
        | Supported: true, false.
        |
        */

        'auto_register' => true,

        /*
        |--------------------------------------------------------------------------
        | Auto Boot
        |--------------------------------------------------------------------------
        |
        | Here you may specify if the plugins are booted when all plugins
        | have been registered, similar to Laravel service providers. It allows you
        | to fire a callback once all plugins are available.
        |
        | Plugins must be auto-registered to be auto-booted.
        |
        | Supported: true, false.
        |
        */

        'auto_boot' => true,
    ]

];