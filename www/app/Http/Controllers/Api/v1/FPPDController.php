<?php namespace FPP\Http\Controllers\Api\v1;

use Carbon\Carbon;
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

	/**
	 * Start FPPD
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
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

	/**
	 * Stop FPPD
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
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

	/**
	 * Restart FPPD
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
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

	/**
	 * Returns FPPD mode
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getMode()
	{
		$fpp = app('FPP\Services\FPP');

		return response()->json(['response' => ['mode' =>$fpp->getFPPDMode()]]);
	}


	/**
	 * Set FPPD Mode
	 * @param $mode
	 */
	public function setMode($mode)
	{

	}

	/**
	 * Return boolean
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function isRunning()
	{
		$sh = new Shell;
		$status = $sh('if ps cax | grep -q fppd; then echo \"true\"; else echo \"false\"; fi');
		return response()->json(['reponse' => $status]);
	}

	/**
	 * Returns FPP status
	 *
	 * @param FPP $fpp
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function status(FPP $fpp)
	{
		try {
			return response()->json(['response' => $fpp->status()]);
		} catch(FPPCommandException $e) {
			return response()->json(['error' => $e->getMessage()]);
		}

	}

	/**
	 * Returns dummy FPP status
	 * 
	 *
	 * @param FPP $fpp
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function fstatus()
	{
		$status = [
			'mode' => 2,
			'status' => 0,
			'volume' => 0,
			'playlist' => 'No playlist scheduled.',
			'currentDate' => Carbon::now(),
			'repeatMode' => 0

		];
		return response()->json(['response' => $status]);
	}
}
