<?php namespace FPP\Commands\Playlist;

use FPP\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class StartPlaylist extends Command implements SelfHandling {

	public $playlist;
	public $entry;
	public $repeat;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($playlist, $entry = 0, $repeat = false)
	{
		$this->playlist = $playlist;
		$this->entry = $entry;
		$this->repeat = $repeat;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{

	}

}
