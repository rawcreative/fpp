<?php namespace FPP\Console\Commands;

use FPP\Plugins\PluginInterface;
use Plugins;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PluginCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'plugin:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Lists currently available plugins';

	protected $headers = array(
		'Plugin Name','Slug', 'Description', 'Installed', 'Active'
	);

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->plugins = Plugins::all();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$plugins = $this->getPlugins();

		$this->table($this->headers, $plugins);
	}

	protected function getPlugins()
	{
		$plugins = array();

		foreach ($this->plugins as $plugin)
		{
			$plugins[] = $this->getPluginInfo($plugin);
		}

		return array_filter($plugins);
	}

	protected function getPluginInfo(PluginInterface $plugin) {

		return [
			'name' => $plugin->name,
			'slug' => $plugin->getSlug(),
			'description' => $plugin->description,
			'installed' => $plugin->isInstalled() ? 'Yes' : 'No',
			'active' => $plugin->isEnabled() ? 'Yes' : 'No'
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
