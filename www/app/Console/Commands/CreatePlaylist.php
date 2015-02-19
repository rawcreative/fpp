<?php namespace FPP\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreatePlaylist extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'playlist:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Playlist.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		if(!$name = $this->argument('name')) {
			if(!$name = $this->ask('Enter a name for your playlist.')) {
				$this->error('You must provide a name for your playlist.');
				return false;
			}
		}

		if(!$type = $this->option('type'))
			$type = $this->ask('Enter the type of playlist: [media_sequence|media|sequence|pause|event|plugin] Default: media_sequence');


	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['name', InputArgument::OPTIONAL, 'The name of the playlist.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['type', null, InputOption::VALUE_OPTIONAL, 'Type of playlist. Accepts: media_sequence, media, sequence, pause, event, plugin', false],
			['first_once', null, InputOption::VALUE_OPTIONAL, 'Play the first entry only once?.', false],
			['last_once', null, InputOption::VALUE_OPTIONAL, 'Play the last entry only once?.', false],
		];
	}

}
