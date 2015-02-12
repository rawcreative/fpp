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

		$status = exec("if ps cax | grep -q fppd; then echo \"true\"; else echo \"false\"; fi");
		if( $status == 'false') {
			try {
				Shell::sudo("$scripts/fppd_start");
			} catch (ShellWrapException $e) {
				throw new FPPCommandException('Exception executing fppd_start');
			}
		} else {
			throw new FPPCommandException('FPPD already running!');
		}


		event('fppd.started');
	}

}
