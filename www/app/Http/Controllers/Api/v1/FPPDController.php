<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Commands\RestartFPPD;
use FPP\Commands\StartFPPD;
use FPP\Commands\StopFPPD;
use FPP\Exceptions\FPPCommandException;
use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;

class FPPDController extends Controller {

	use DispatchesCommands;

	public function start()
	{
		try {
			$this->dispatch(new StartFPPD());
		}
		catch(FPPCommandException $e) {
			return response()->json(['error' => $e->getMessage()]);
		}

	}

	public function stop()
	{
		try {
			$this->dispatch(new StopFPPD());
		}
		catch(FPPCommandException $e) {
			return response()->json(['error' => $e->getMessage()]);
		}
	}

	public function restart()
	{
		try {
			$this->dispatch(new RestartFPPD());
		}
		catch(FPPCommandException $e) {
			return response()->json(['error' => $e->getMessage()]);
		}
	}


}
