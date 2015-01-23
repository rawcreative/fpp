<?php
namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Controllers\Controller;
use FPP\Services\FPP;
use Illuminate\Support\Facades\Response;

class StatusController extends Controller {

	protected $fpp;

	function __construct(FPP $fpp)
	{
		$this->fpp = $fpp;
	}


	/**
	 * Display a listing of the resource.
	 * GET /status
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json($this->fpp->status());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /status/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /status
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /status/{id}
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
	 * GET /status/{id}/edit
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
	 * PUT /status/{id}
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
	 * DELETE /status/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}