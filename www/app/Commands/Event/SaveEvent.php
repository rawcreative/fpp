<?php namespace FPP\Commands\Event;

use FPP\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class SaveEvent extends Command implements SelfHandling {

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
	public function handle()
	{
		//
	}

}
