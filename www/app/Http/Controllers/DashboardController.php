<?php namespace FPP\Http\Controllers;

use FPP\Http\Controllers\Controller;
use FPP\Services\FPP;
use FPP\Services\Pi;

class DashboardController extends Controller
{

    /**
     * Display the dashboard page
     *
     * @return Response
     */
    public function index(Pi $pi, FPP $fpp)
    {
        $status = $fpp->status();
        $status['playlists'] = $fpp->getPlaylists(true);
        $status['date'] = $pi->getLocalTime();
        $status['volume'] = $fpp->getVolume();

        $initialData = $status;

        return view('dashboard.dashboard', compact('initialData'));
    }

}
