<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    /**
     * Retrieve all music files from media dir
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMusicFiles()
    {
        $files = $this->getFiles(fpp_media('music'));

        return response()->json(['response' => ['musicFiles' => $files]]);
    }

    /**
     * Retrieve all sequence files from media dir
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSequenceFiles()
    {

        $files = $this->getFiles(fpp_media('sequences'));

        return response()->json(['response' => ['sequenceFiles' => $files]]);
    }

    /**
     * Retrieve all video files from /media/videos
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getVideoFiles()
    {
        $files = $this->getFiles(fpp_media('videos'));

        return response()->json(['response' => ['videoFiles' => $files]]);
    }

    /**
     * Retrieve all files from media dir
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllFiles()
    {
        $files = $this->getFiles();

        return response()->json(['response' => ['files' => $files]]);
    }


    /**
     * Retrieve files from directory
     *
     * @param string $directory
     * @return array
     */
    protected function getFiles($directory = false)
    {
        if ($directory && file_exists($directory)) {

            $files = array_values(array_filter(scandir($directory), function ($file) {
                return ($file[0] != ".");
            }));

            return $files;
        }

        return array_values(array_filter(Storage::disk('pi')->allFiles('/'), function ($file) {
            return ($file[0] != ".");
        }));

    }

}
