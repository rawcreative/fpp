<?php namespace FPP\Providers;

use FPP\Http\Responses\Output;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;

class HttpServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance('League\Fractal\Manager', new Manager);
        $this->app->singleton('FPP\Http\Responses\Output', function ($app) {
            return new Output($app['League\Fractal\Manager']);
        });
    }

}
