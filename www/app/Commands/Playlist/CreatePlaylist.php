<?php namespace FPP\Commands\Playlist;

use FPP\Commands\Command;

use FPP\Playlist;
use Illuminate\Contracts\Bus\SelfHandling;

class CreatePlaylist extends Command implements SelfHandling {

	public $name;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle(Playlist $playlist)
	{
		 $playlist->create($this->name);
	}

}
