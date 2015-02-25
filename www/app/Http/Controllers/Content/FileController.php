<?php namespace FPP\Http\Controllers\Content;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

class FileController extends Controller {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$files = \Media::getAllMediaFiles();

		return view('files.index', compact('files'));
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

		$file = \Request::file('file');

		if($file) {
			$types = collect([ 
					'fseq' => fpp_media('sequences'),
					'mp3' => fpp_media('music'),
					'ogg' => fpp_media('music'),
					'mp4' => fpp_media('videos'),
					'mkv' => fpp_media('videos'),
					'eseq' => fpp_media('effects'),
					'sh' => fpp_media('scripts'),
					'pl' => fpp_media('scripts'),
					'pm' => fpp_media('scripts'),
					'php' => fpp_media('scripts'),
					'py' => fpp_media('scripts')
					]);

			$type = $file->getClientOriginalExtension();
			

			$destFolder = $types->get($type, fpp_media('upload'));
			$filename = $file->getClientOriginalName();
	        $upload_success = $file->move($destFolder, $filename);
	        
	        if ($upload_success) {
	        	event('file.uploaded', ['path' => $destFolder.'/'.$filename, 'file' => $filename, 'type' => $type]);
	        	return response()->json('success', 200);
       		 } else {
            	return response()->json('error', 400);
        	}


    	}

    	flash()->error('No File Provided');
    	return redirect()->back();

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
