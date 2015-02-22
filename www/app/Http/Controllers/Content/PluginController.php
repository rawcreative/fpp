<?php namespace FPP\Http\Controllers\Content;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;
use FPP\Plugins\Repositories\PluginRepositoryInterface;
use Illuminate\Http\Request;

class PluginController extends Controller {

	public function __construct(
		PluginRepositoryInterface $plugins
	)
	{
		$this->plugins = $plugins;

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$installedPlugins = $this->plugins->findInstalled();

		return view('plugins.index', compact('installedPlugins'));
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

	public function enablePlugin(Request $request)
	{

		if(!$slug = $request->input('slug')) {
			flash()->error('Plugin Enable Failed');
			return redirect()->back();
		}

		$this->plugins->enable($slug);

		flash()->success('Plugin Enabled');

		return redirect()->back();


	}

	public function disablePlugin(Request $request)
	{

		if(!$slug = $request->input('slug')) {
			flash()->error('Plugin Disable Failed');
			return redirect()->back();
		}

		$this->plugins->disable($slug);
		flash()->success('Plugin Disabled');

		return redirect()->back();


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
