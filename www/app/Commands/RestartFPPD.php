<?php namespace FPP\Commands;

use FPP\Commands\Command;

use FPP\Services\FPPCommand;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\Process\Process;

class RestartFPPD extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle(FPPCommand $command)
	{
		//

		try {

			$command->send('d');
			$process = new Process('')
			$status=exec($SUDO . " " . dirname(dirname(__FILE__)) . "/scripts/fppd_stop");

		} catch(FPPCommandException $exception) {

		}
	}

}
