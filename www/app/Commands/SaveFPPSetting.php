<?php namespace FPP\Commands;

use FPP\Collection;
use FPP\Commands\Command;

use FPP;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Storage;


class SaveFPPSetting extends Command implements SelfHandling {

	public $name;
	public $value;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($name, $value)
	{
		$this->name = $name;
		$this->value = $value;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		try {
			$settings = new Collection(FPP::getSettings());
			$settings->put($this->name, $this->value);
			Storage::disk('pi')->put('settings', $settings->toIni());
		} catch(\Exception $e) {
			throw new FPP\Exceptions\FPPSettingsException('Error Saving Setting: '.$e->getMessage());
		}

		event('settings.save', [$settings]);
	}

}
