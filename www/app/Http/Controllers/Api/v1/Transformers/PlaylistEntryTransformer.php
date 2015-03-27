<?php

namespace FPP\Http\Controllers\Api\v1\Transformers;


use FPP\Playlist;
use League\Fractal\TransformerAbstract;

class PlaylistEntryTransformer extends TransformerAbstract
{


    public function transform($entries)
    {
        return [
            'name'       => $playlist->name,
            'first_once' => $playlist->firstOnce,
            'last_once'  => $playlist->lastOnce,
        ];

    }

    /**
     * Include Author
     *
     * @return \League\Fractal\ItemResource
     */
    public function includeDetails(Playlist $playlist)
    {
        $entries = $playlist->entries;

        return $this->item($entries, new PlaylistEntryTransformer);
    }

}