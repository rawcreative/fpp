<?php namespace FPP\Http\Controllers\Settings;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;
use FPP\Services\FPP;

class SettingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(FPP $fpp)
	{
		$soundCards = $fpp->getSoundCards();
		$settings = $fpp->getSettings();

		return view('settings.index', compact('soundCards', 'settings'));
	}

	public function showNetwork()
	{
		return view('settings.network');
	}

	public function showEmail()
	{
		return view('settings.email');
	}

	public function showLogs()
	{
		return view('settings.logs');
	}

	public function showDate()
	{
		return view('settings.date');
	}

	public function storeDate()
	{

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


	public function storeNetwork()
	{
		//
	}

	public function storeEmail()
	{
		//
	}

	public function storeLogs()
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
