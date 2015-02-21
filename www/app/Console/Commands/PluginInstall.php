<?php namespace FPP\Console\Commands;

use Plugins;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PluginInstall extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'plugin:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Installs an available plugin';

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
		$plugin = Plugins::get($this->argument('slug'));
		if($plugin && $plugin->canInstall()) {
			$plugin->install();
			$this->comment($plugin->name.' successfully installed.');
		} else {
			$this->error('Plugin Not Found');
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
			['slug', InputArgument::REQUIRED, 'The slug of the plugin you wish to install.'],
		];
	}


}
