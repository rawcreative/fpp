<?php


namespace FPP\Providers;

use FPP\Plugins\Plugin;
use FPP\Plugins\FileFinder;
use FPP\Plugins\PluginBag;
use Illuminate\Support\ServiceProvider;

class PluginsServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $app = $this->app;

        // Plugins are auto-registered upon booting of the Plugins Service Provider 
        if ($app['config']->get('fpp.plugins.auto_register')) {
            Plugin::setConnectionResolver($app['db']);
            Plugin::setEventDispatcher($app['events']);
            Plugin::setMigrator($app['migrator']);

            $app['plugins']->findAndRegisterPlugins();
            $app['plugins']->sortPlugins();

            // Now we will check if the plugins should be auto-booted.
            if ($app['config']->get('fpp.plugins.auto_boot')) {
                foreach ($app['plugins'] as $extension) {
                    $extension->setupDatabase();
                }

                foreach ($app['plugins']->allEnabled() as $extension) {
                    $extension->boot();
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {

       $this->app->bind('FPP\Plugins\Repositories\PluginRepositoryInterface',
           'FPP\Plugins\Repositories\PluginRepository');

       $this->registerPluginsFinder();
       $this->registerPlugins();
    }


    /**
     * Registers the plugins finder.
     *
     * @return void
     */
    protected function registerPluginsFinder()
    {
        $this->app['plugins.finder'] = $this->app->share(function ($app) {
            $paths = $app['config']->get('fpp.plugins.paths');

            return new FileFinder($app['files'], $paths);
        });
    }

    /**
     * Registers the plugins bag.
     *
     * @return void
     */
    protected function registerPlugins()
    {
        $this->app['plugins'] = $this->app->share(function ($app) {
            return new PluginBag($app['files'], $app['plugins.finder'], $app, [], $app['cache']);
        });

        $this->app->alias('plugins', 'FPP\Plugins\PluginBag');
    }
}
