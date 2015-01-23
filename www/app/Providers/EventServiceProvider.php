<?php namespace FPP\Providers;

use BrainSocket\BrainSocket;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
//		'status.request' => [
//			'FPP\Handlers\Events\StatusRequest@handle'
//		]
	];

}
