<?php namespace FPP\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeletePlaylist extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'playlist:delete';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Deletes a playlist.';

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
		$playlist = $this->argument('playlist');
		if ($this->confirm("Are you sure you want to delete the $playlist playlist? [yes|no]"))
		{
			//dispatch delete playlist command
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['playlist', InputArgument::REQUIRED, 'The playlist to delete.'],
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
			//['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
