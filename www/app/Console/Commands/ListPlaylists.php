<?php namespace FPP\Console\Commands;

use FPP\Services\FPP;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ListPlaylists extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'playlist:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List all playlists and their contents';

	
	protected $headers = array(
		'Domain', 'Method', 'URI', 'Name', 'Action', 'Middleware'
	);

	protected $fpp;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(FPP $fpp)
	{
		$this->fpp = $fpp;
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['example', InputArgument::REQUIRED, 'An example argument.'],
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
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
