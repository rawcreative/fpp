<?php namespace FPP\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'FPP\Console\Commands\InspireCommand',
		'FPP\Console\Commands\CreatePlaylist',
		'FPP\Console\Commands\DeletePlaylist',
		'FPP\Console\Commands\PluginCommand',
		'FPP\Console\Commands\PluginInstall',
		'FPP\Console\Commands\PluginEnable',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();
	}

}
