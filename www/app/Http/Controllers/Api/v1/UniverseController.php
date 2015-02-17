<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;

use FPP\Services\Outputs\E131;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class UniverseController extends Controller
{
    public $e131;

    public function __construct(E131 $e131)
    {
        $this->e131 = $e131;
    }

    public function universes()
    {
        $universes = $this->e131->getUniverses();

        return response()->json([
            'response' => [
                'universes' => $universes
            ]
        ]);

    }

    public function getUniverse($universe)
    {

        $results = $this->e131->getUniverse($universe);

        if ( ! empty($results)) {
            return response()->json([
                'response' => [
                    'universe' => $results
                ]
            ]);
        }

        return reponse()->json(['error' => 'Universe not found']);

    }

    public function addUniverse($payload)
    {

    }

    public function deleteUniverse($universe)
    {

    }



}
