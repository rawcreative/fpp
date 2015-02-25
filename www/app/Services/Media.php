<?php
namespace FPP\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Media
{

    /**
     * Retrieve all music files
     *
     * @return array
     */
    public function getMusicFiles($fileinfo = false)
    {
        if ($fileinfo) {
            return $this->getFilesWithInfo(fpp_media('music'));
        }

        return $this->getFiles(fpp_media('music'));
    }

    /**
     * Retrieve all sequence files
     *
     * @return array
     */
    public function getSequenceFiles($fileinfo = false)
    {
        if ($fileinfo) {
            return $this->getFilesWithInfo(fpp_media('sequences'));
        }

        return $this->getFiles(fpp_media('sequences'));
    }

    /**
     * Retrieve all video files
     *
     * @return array
     */
    public function getVideoFiles($fileinfo = false)
    {
        if ($fileinfo) {
            return $this->getFilesWithInfo(fpp_media('videos'));
        }

        return $this->getFiles(fpp_media('videos'));
    }

    /**
     * Returns all files in upload directory
     *
     * @return array
     */
    public function getUploadFiles($fileinfo = false)
    {
        if ($fileinfo) {
            return $this->getFilesWithInfo(fpp_media('upload'));
        }

        return $this->getFiles(fpp_media('upload'));
    }

    /**
     * Returns all script files
     *
     * @return array
     */
    public function getScriptFiles($fileinfo = false)
    {
        if ($fileinfo) {
            return $this->getFilesWithInfo(fpp_media('scripts'));
        }

        return $this->getFiles(fpp_media('scripts'));
    }

    /**
     * Returns all effects files
     *
     * @return array
     */
    public function getEffectsFiles($fileinfo = false)
    {
        if ($fileinfo) {
            return $this->getFilesWithInfo(fpp_media('effects'));
        }

        return $this->getFiles(fpp_media('effects'));
    }

    /**
     * Returns all log files
     *
     * @return array
     */
    public function getLogFiles($fileinfo = false)
    {
        if ($fileinfo) {
            return $this->getFilesWithInfo(fpp_media('logs'));
        }

        return $this->getFiles(fpp_media('logs'));
    }


    /**
     * Retrieve all files
     *
     * @return array
     */
    public function getAllFiles($fileinfo = false)
    {
        if ($fileinfo) {
            return $this->getFilesWithInfo();
        }

        return $this->getFiles();
    }

    /**
     * Retrieve all files w/ fileinfo
     *
     * @return array
     */
    public function getAllFilesWithInfo()
    {
        return $this->getFilesWithInfo();
    }


    /**
     * Retrieve a collection of all media files
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllMediaFiles()
    {

        return collect([
            'music'     => $this->getMusicFiles(true),
            'sequences' => $this->getSequenceFiles(true),
            'videos'    => $this->getVideoFiles(true),
            'scripts'   => $this->getScriptFiles(true),
            'effects'   => $this->getEffectsFiles(true),
            'logs'      => $this->getLogFiles(true),
            'upload'    => $this->getUploadFiles(true)
        ]);
    }


    /**
     * Retrieve files from directory
     *
     * @param string $directory
     * @return array
     */
    protected function getFiles($directory = false)
    {
        if ($directory) {
            if(file_exists($directory)){

                $files = array_values(array_filter(scandir($directory), function ($file) {
                    return ($file[0] != ".");
                }));

                return $files;
            }
            return [];
        }

        return array_values(array_filter(Storage::disk('pi')->allFiles('/'), function ($file) {
            return ($file[0] != ".");
        }));

    }

    protected function getFilesWithInfo($directory = false)
    {
        if ($directory) {
            $files = $this->getFiles($directory);
        } else {
            $files     = $this->getFiles();
            $directory = fpp_media();
        }


        $formatted = array_map(function ($file) use ($directory) {
            $path = trailingslashit($directory) . $file;
            return [
                'name'          => basename($file),
                'path'          => $path,
                'size'          => filesize($path),
                'last_modified' => Carbon::createFromTimestamp(filemtime($path))->toDateTimeString()
            ];
        }, $files);


        return $formatted;
    }

}