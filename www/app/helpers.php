<?php


function fpp_dir() {
    return dirname(base_path());
}


if(!function_exists('fpp_media')) {

    function fpp_media($directory = false) {
        $conf = 'fpp.media';

        if($directory)
            $conf = 'fpp.'.$directory;

        return config($conf);
    }
}