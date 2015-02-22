<?php namespace FPP\Providers;

use FPP\Menu\Menu;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class MenuServiceProvider extends BaseServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{

        //$this->app['config']->set('fpp/menu::config', $settings);

		// Extending Blade engine
		//require_once('Extensions/BladeExtension.php');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app['menu'] = $this->app->share(function($app){

		 		return new Menu();
		 });


	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('menu');
	}

}
