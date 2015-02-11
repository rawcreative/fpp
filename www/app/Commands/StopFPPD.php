<?php namespace FPP\Commands;

use FPP\Commands\Command;

use FPP\Exceptions\FPPCommandException;
use FPP\Services\FPPCommand;
use Illuminate\Contracts\Bus\SelfHandling;
use MrRio\ShellWrapException;
use Symfony\Component\Process\Process;
use MrRio\ShellWrap as Shell;

class StopFPPD extends Command implements SelfHandling {


	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle(FPPCommand $command)
	{
		$command->send('d');
		$scripts = fpp_dir().'/scripts';

		try {
			Shell::sudo("$scripts/fppd_stop");

		} catch (ShellWrapException $e) {
			throw new FPPCommandException('Exception executing fppd_stop');
		}


		event('fppd.stopped');
	}

}
