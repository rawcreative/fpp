<?php namespace FPP\Handlers\Events;

use BrainSocket;
use FPP\Services\FPP;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class StatusRequest {
	protected $fpp;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(FPP $fpp)
	{
		$this->fpp = $fpp;
	}

	/**
	 * Handle the event.
	 *
	 * @param  StatusRequest  $event
	 * @return void
	 */
	public function handle($event)
	{
		//
	}

	public function getStatus()
	{
		return BrainSocket::message('status.request', ['message'=> $this->fpp->status()]);
	}

}
