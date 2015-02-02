<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Commands\RestartFPPD;
use FPP\Commands\StartFPPD;
use FPP\Commands\StopFPPD;
use FPP\Exceptions\FPPCommandException;
use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;
use FPP\Services\FPP;
use MrRio\ShellWrap as Shell;
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

		return response()->json(['response' => 'success']);

	}

	public function stop()
	{
		try {
			$this->dispatch(new StopFPPD());
		}
		catch(FPPCommandException $e) {
			return response()->json(['error' => $e->getMessage()]);
		}
		return response()->json(['response' => 'success']);
	}

	public function restart()
	{
		try {
			$this->dispatch(new RestartFPPD());
		}
		catch(FPPCommandException $e) {
			return response()->json(['error' => $e->getMessage()]);
		}
		return response()->json(['response' => 'success']);
	}


	public function getMode()
	{
		$fpp = app('FPP\Services\FPP');

		return response()->json(['response' => ['mode' =>$fpp->getFPPDMode()]]);
	}

	public function setMode($mode)
	{

	}


	public function isRunning()
	{
		$sh = new Shell;
		$status = $sh('if ps cax | grep -q fppd; then echo \"true\"; else echo \"false\"; fi');
		return response()->json(['reponse' => $status]);
	}
}
