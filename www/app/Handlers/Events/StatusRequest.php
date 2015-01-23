<?php namespace FPP\Handlers\Events;

use BrainSocket\BrainSocket;
use FPP\Events\StatusRequest;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class StatusRequest {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  StatusRequest  $event
	 * @return void
	 */
	public function handle()
	{
		BrainSocket::message('status.request',array('message'=>'A message from a generic event fired in Laravel!'));
	}

}
