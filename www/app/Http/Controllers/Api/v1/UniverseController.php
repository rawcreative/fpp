<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class UniverseController extends Controller
{

    public function universes()
    {
        $universes = $this->getUniverses();

        return response()->json([
            'response' => [
                'universes' => $universes
            ]
        ]);

    }

    public function getUniverse($universe)
    {
        $universes = collect($this->getUniverses());

        $results = $universes->where('universe', $universe);

        if ( ! empty($results)) {
            return response()->json([
                'response' => [
                    'universe' => $results
                ]
            ]);
        }

        return reponse()->json(['error' => 'Universe not found']);

    }

    public function deleteUniverse($universe)
    {

    }

    protected function getUniverses()
    {
        $universes = [];
        if ( ! Cache::has('fpp_universes')) {

            $csv       = Reader::createFromPath(config('fpp.universes'));
            $universes = $csv->fetchAssoc(['active', 'universe', 'startAddress', 'size', 'type', 'unicastAddress']);

            Cache::put('fpp_universes', $universes, 60);

        } else {
            $universes = Cache::get('fpp_universes');
        }

        return $universes;
    }


}
