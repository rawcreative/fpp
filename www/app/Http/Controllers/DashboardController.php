<?php namespace FPP\Http\Controllers;


use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;
use FPP\Services\FPP;
use FPP\Services\Pi;

class DashboardController extends Controller {

	/**
	 * Display the dashboard page
	 *
	 * @return Response
	 */
	public function index(Pi $pi, FPP $fpp)
	{
		$status = $fpp->status();
		$status['playlists'] = $fpp->getPlaylists();
		$status['date'] = $pi->getLocalTime();
		$status['volume'] = $fpp->getVolume();

		$initialData = $status;
		// \JavaScript::put([
		// 	'status' => $status,
		// 	'playlists' => $playlists,
		// 	'date' => $pi->getLocalTime(),
		// 	'volume' => $fpp->getVolume()
		// ]);

		return view('dashboard.dashboard', compact('initialData'));
	}


}
