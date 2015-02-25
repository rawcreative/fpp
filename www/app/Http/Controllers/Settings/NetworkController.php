<?php namespace FPP\Http\Controllers\Settings;

use FPP\Services\Pi;
use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

class NetworkController extends Controller {

	protected $pi;

	public function __construct(Pi $pi)
	{
		$this->pi = $pi;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		if(env('APP_DEV')) {
			$interfaces = ['eth0' => 'eth0', 'wlan0' => 'wlan0'];
		} else {
			$ifaces = $this->pi->getNetworkInterfaces();
			$interfaces = [];
			foreach($ifaces as $iface) {
				$interfaces[$iface] = $iface;
			}
		}		

		return view('settings.network', compact('interfaces'));
	}

	public function dns()
	{
		$dns = $this->pi->getDNSInfo();
		$hostname = \FPP::getSetting('hostname');
		$dhcp = true;

		if(!$dns['DNS1'] || !$dns['DNS2']) {
			$dhcp = false;
		}

		return view('settings.network-dns', compact('dns', 'hostname', 'dhcp'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
