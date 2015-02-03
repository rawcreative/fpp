<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class PlaylistController extends Controller
{

    /**
     * Returns playlists
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPlaylists()
    {
        $playlists = array_values(array_filter(scandir(config('fpp.playlists')), function ($file) {
            return $file != '.' && $file != '..';
        }));

        return response()->json(['response' => ['playlists' => $playlists]]);
    }

    /**
     * Returns playlist detail
     *
     * @param $playlist
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPlaylist($playlist)
    {
        if (Storage::disk('pi')->exists("playlists/$playlist")) {

            $csv       = Reader::createFromPath(trailingslashit(config('fpp.playlists')) . $playlist);
            $firstLast = $csv->fetchOne();
            $entries   = $csv->setOffset(1)->fetchAssoc(['type', 'sequence', 'media']);

            return response()->json([
                'response' => [
                    'playlist' => [
                        'name'       => $playlist,
                        'first_once' => $firstLast[0],
                        'last_once'  => $firstLast[1],
                        'entries'    => $entries
                    ]
                ]
            ]);
        }
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

    protected function parsePlaylist($data)
    {

    }


}
