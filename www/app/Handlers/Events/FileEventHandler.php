<?php namespace FPP\Handlers\Events;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class FileEventHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}


	public function fileUploaded($data)
	{
		return \BrainSocket::message('file.uploaded', ['message'=> $data]);
	}

	public function fileDeleted($data)
	{

	}

}
