<?php
namespace FPP\Services\Outputs;


use Illuminate\Support\Facades\Cache;
use League\Csv\Reader;

class E131 {

    public function getUniverse($universe)
    {
        $universes = collect($this->getUniverses());

       return $universes->where('universe', $universe)->first();
    }

    public function getUniverses()
    {
        $universes = [];

        if ( ! Cache::has('fpp_universes')) {

            $csv       = Reader::createFromPath(fpp_media('universes'));
            $universes = $csv->fetchAssoc(['active', 'universe', 'startAddress', 'size', 'type', 'unicastAddress']);

            Cache::put('fpp_universes', $universes, 60);

        } else {
            $universes = Cache::get('fpp_universes');
        }

        return $universes;
    }
}