<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class UniverseController extends Controller {

	public function getUniverses()
	{
		if(!Cache::has('fpp_universes')) {
			if (Storage::disk('pi')->exists("universes")) {
				$csv       = Reader::createFromPath(config('fpp.universes'));
				$entries   = $csv->fetchAssoc(['active', 'universe', 'startAddress', 'size', 'type', 'unicastAddress']);

				Cache::put('fpp_universes', $entries, 60);
			}
		} else {
			$entries = Cache::get('fpp_universes');
		}

		return response()->json([
			'response' => [
				'universes' => $entries
			]
		]);

	}

	public function getUniverse($universe)
	{

	}

	public function deleteUniverse($universe)
	{

	}
	

}
