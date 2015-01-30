<?php namespace FPP\Commands;

use FPP\Commands\Command;

use FPP\Exceptions\FPPCommandException;
use Illuminate\Contracts\Bus\SelfHandling;
use MrRio\ShellWrapException;
use Symfony\Component\Process\Process;
use MrRio\ShellWrap as Shell;

class StartFPPD extends Command implements SelfHandling {

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$scripts = fpp_dir().'/scripts';
//		$process = new Process("sudo $scripts/fppd_start");
//		$process->run();
//
//		if (!$process->isSuccessful()) {
//			throw new FPPCommandException($process->getErrorOutput());
//
//		}
		$stop = new Shell;
		try {
			$stop("sudo $scripts/fppd_stop");
		} catch (ShellWrapException $e) {
			throw new FPPCommandException('Exception executing fppd_stop');
		}


		event('fppd.started');
	}

}
