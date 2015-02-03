<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    public function getMusicFiles()
    {
//        $files = array_values(array_filter(scandir(config('fpp.music')), function ($file) {
//            return $file != '.' && $file != '..';
//        }));

        $files = $this->getFiles(config('fpp.music'));

        return response()->json(['response' => ['musicFiles' => $files]]);
    }

    public function getSequences()
    {

        $files = $this->getFiles(config('fpp.sequences'));

        return response()->json(['response' => ['sequenceFiles' => $files]]);
    }

    public function getVideoFiles()
    {
        $files = $this->getFiles(config('fpp.videos'));

        return response()->json(['response' => ['videoFiles' => $files]]);
    }

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
