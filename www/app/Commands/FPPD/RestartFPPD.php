<?php namespace FPP\Commands\FPPD;

use FPP\Commands\Command;

use FPP\Exceptions\FPPCommandException;
use FPP\Services\FPPCommand;
use Illuminate\Contracts\Bus\SelfHandling;
use MrRio\ShellWrapException;
use Symfony\Component\Process\Process;
use MrRio\ShellWrap as Shell;

class RestartFPPD extends Command implements SelfHandling {

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle(FPPCommand $command)
	{

		$command->send('d');
		$scripts = fpp_dir().'/scripts';

		$sh = new Shell;

		try {
			$sh::sudo("$scripts/fppd_stop");

		} catch (ShellWrapException $e) {

				throw new FPPCommandException('Exception executing fppd_stop');
		}

		try {

				$sh::sudo("$scripts/fppd_start");

		} catch (ShellWrapException $e) {
			throw new FPPCommandException('Exception executing fppd_start');
		}


		event('fppd.restarted');

	}

}