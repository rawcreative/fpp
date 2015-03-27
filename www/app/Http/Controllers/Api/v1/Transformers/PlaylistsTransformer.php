<?php

namespace FPP\Http\Controllers\Api\v1\Transformers;


use FPP\Playlist;
use League\Fractal\TransformerAbstract;

class PlaylistsTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'details'
    ];

    public function transform(Playlist $playlist)
    {
        return [
            'name'  => $playlist->name

        ];
    }

    /**
     * Include Details
     *
     * @return \League\Fractal\ItemResource
     */
    public function includeDetails(Playlist $playlist)
    {
        $entries = $playlist->entries;

        return $this->item($entries, function($entry) {
            return $entry->toArray();
        });
    }

}