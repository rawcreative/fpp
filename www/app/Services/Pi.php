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
        if(!Cache::has('timezone')) {
            if (Storage::disk('pi')->exists(config('fpp.media').'/timezone')) {
                $timezone = Storage::disk('pi')->get(config('fpp.media').'/timezone');

                Cache::put('timezone', $timezone);
                return $timezone;
            }
            return Carbon::now()->timezoneName;
        }
        return Cache::get('timezone');
    }
}