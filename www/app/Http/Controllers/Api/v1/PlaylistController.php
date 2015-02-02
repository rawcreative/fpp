<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

class PlaylistController extends Controller {

	public function getPlaylists()
	{
		$playlists = array_values(array_filter(scandir(config('fpp.playlists')), function($file) {
			return $file != '.' && $file != '..';
		}));

		return response()->json(['response' => ['playlists'=>$playlists]]);
	}

	public function getPlaylist($id)
	{

	}

	public function createPlaylist()
	{

	}

	public function updatePlaylist()
	{

	}

	public function deletePlaylist($id)
	{

	}

	public function addEntry($entry)
	{

	}

	public function deleteEntry($id)
	{

	}

	public function getPlaylistSettings($id)
	{

	}

	public function getPlaylistEntries($id)
	{

	}

	public function addFirstItem()
	{

	}

	public function deleteFirstItem($id)
	{

	}

	public function addLastItem()
	{

	}

	public function deleteLastItem($id)
	{

	}



}
