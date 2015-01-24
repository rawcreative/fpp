<?php namespace FPP\Commands;

use FPP\Commands\Command;

use FPP\Exceptions\FPPCommandException;
use FPP\Services\FPPCommand;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\Process\Process;

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
		$process = new Process("sudo $scripts/fppd_stop");
		$process->run();

		if (!$process->isSuccessful()) {
			throw new FPPCommandException($process->getErrorOutput());
		}

		event('fppd.stopped');
	}

}
