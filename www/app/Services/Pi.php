<?php


namespace FPP\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Pi {

    public function getNetworkInterfaces()
    {
        // ifconfig | cut -f1 -d' ' | grep -v ^$ | grep -v lo | grep -v eth0:0
    }

    public function getInterfaceInfo($interface)
    {
        //compile and return network interface info
    }

    public function rebootPi()
    {

    }

    public function getTimezone()
    {

            if (Storage::disk('pi')->exists('timezone')) {
                $timezone = trim(Storage::disk('pi')->get('timezone'));
                return $timezone;
            }
            return Carbon::now()->timezoneName;


    }
}