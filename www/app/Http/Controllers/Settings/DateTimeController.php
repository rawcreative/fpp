<?php namespace FPP\Http\Controllers\Settings;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

use FPP\Services\FPP;
use FPP\Services\Pi;
use Illuminate\Http\Request;

class DateTimeController extends Controller {

	protected $pi;
	protected $fpp;

	public function __construct(Pi $pi, FPP $fpp)
	{
		$this->fpp = $fpp;
		$this->pi = $pi;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$currentTimezone = urlencode($this->pi->getTimezone());
		$timezones = $this->pi->getTimezones();
		$ntp = $this->pi->ntpEnabled();
		$rtc = $this->fpp->getSetting('piRTC');

		return view('settings.date', compact('currentTimezone', 'timezones', 'ntp', 'rtc'));
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
