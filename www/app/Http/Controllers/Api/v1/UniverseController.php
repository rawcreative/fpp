<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Responses\Output;
use FPP\Services\Outputs\E131;

class UniverseController extends ApiController
{
    public $e131;

    public function __construct(Output $output, E131 $e131)
    {
        parent::__construct($output);
        $this->e131 = $e131;
    }

    public function universes()
    {
        $universes = $this->e131->getUniverses();


        return $this->respondWithCollection($universes, function ($universe) {
            return [
                'active'         => (boolean)$universe['active'],
                'universe'       => (integer)$universe['universe'],
                'startAddress'   => (integer)$universe['startAddress'],
                'size'           => (integer)$universe['size'],
                'type'           => (integer)$universe['type'],
                'unicastAddress' => $universe['unicastAddress'],
            ];
        });


    }

    public function getUniverse($universe)
    {

        $results = $this->e131->getUniverse($universe);

        if ( ! empty($results)) {
            return $this->respondWithItem($results, function($universe) {
                return [
                    'active'         => (boolean)$universe['active'],
                    'universe'       => (integer)$universe['universe'],
                    'startAddress'   => (integer)$universe['startAddress'],
                    'size'           => (integer)$universe['size'],
                    'type'           => (integer)$universe['type'],
                    'unicastAddress' => $universe['unicastAddress'],
                ];
            });

        }
        $this->statusCode = static::REQUEST_FAILED;

        return $this->respondWithError('Universe Not Found', static::BAD_REQUEST);


    }

    public function addUniverse($payload)
    {

    }

    public function deleteUniverse($universe)
    {

    }

}
