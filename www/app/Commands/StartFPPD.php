<?php namespace FPP\Commands;

use FPP\Commands\Command;

use FPP\Exceptions\FPPCommandException;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\Process\Process;

class StartFPPD extends Command implements SelfHandling {

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$scripts = fpp_dir().'/scripts';
		$process = new Process("sudo $scripts/fppd_start");
		$process->run();

		if (!$process->isSuccessful()) {
			throw new FPPCommandException($process->getErrorOutput());

		}

		event('fppd.started');
	}

}
