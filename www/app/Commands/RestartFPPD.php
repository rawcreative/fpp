<?php namespace FPP\Commands;

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

		//$stop = new Process("sudo $scripts/fppd_stop");
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


//		if (!$stop->isSuccessful()) {
//			throw new FPPCommandException($stop->getErrorOutput());
//			return false;
//		}

//		$start = new Process("sudo $scripts/fppd_start");
//		$start->run();
//		if (!$start->isSuccessful()) {
//			throw new FPPCommandException($start->getErrorOutput());
//		}

		event('fppd.restarted');

	}

}
