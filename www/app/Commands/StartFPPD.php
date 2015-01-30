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

		$sh = new Shell;
		if($sh('if ps cax | grep -q fppd; then echo \"true\"; else echo \"false\"; fi') == 'false') {
			try {
				$sh::sudo("$scripts/fppd_stop");
			} catch (ShellWrapException $e) {
				throw new FPPCommandException('Exception executing fppd_stop');
			}
		} else {
			throw new FPPCommandException('FPPD already running!');
		}


		event('fppd.started');
	}

}
