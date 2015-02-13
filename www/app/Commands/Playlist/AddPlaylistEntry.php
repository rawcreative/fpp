<?php namespace FPP\Commands\Playlist;

use FPP\Commands\Command;

use FPP\Playlist;
use FPP\PlaylistEntry;
use Illuminate\Contracts\Bus\SelfHandling;

class AddPlaylistEntry extends Command implements SelfHandling {

	/**
	 * @var
	 */
	public $type;
	/**
	 * @var
	 */
	public $sequence;
	/**
	 * @var
	 */
	public $media;
	/**
	 * @var Playlist
	 */
	public $playlist;

	/**
	 * Create a new command instance.
	 *
	 * @param $type
	 * @param $sequence
	 * @param $media
	 */
	public function __construct(Playlist $playlist, $type, $sequence, $media)
	{

		$this->type = $type;
		$this->sequence = $sequence;
		$this->media = $media;
		$this->playlist = $playlist;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle(PlaylistEntry $entry)
	{
		// create entry model
		// add to playlist
	}

}
