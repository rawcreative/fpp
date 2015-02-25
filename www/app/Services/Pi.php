<?php


namespace FPP\Services;


use Carbon\Carbon;
use FPP\Exceptions\FPPSettingsException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Log;

class Pi {

    /**
     * Finds and returns available network interfaces
     *
     * @return array
     */
    public function getNetworkInterfaces()
    {

        return explode("\n",trim(shell_exec("/sbin/ifconfig | cut -f1 -d' ' | grep -v ^$ | grep -v lo | grep -v eth0:0")));
    }

    public function getInterfaceInfo($interface)
    {
        //compile and return network interface info
    }

    public function getDNSInfo()
    {
        if(Storage::disk('pi')->exists('config/dns')) {
            $cfg = Storage::disk('pi')->get('config/dns');
            return parse_ini_string($cfg);
        }

        return [];
    }

    public function rebootPi()
    {

    }

    public function getSoundCards()
    {
        $cardArr = [];
        exec("for card in /proc/asound/card*/id; do echo -n \$card | sed 's/.*card\\([0-9]*\\).*/\\1:/g'; cat \$card; done",
            $output, $return_val);

        if ( ! $return_val) {
            Log::error('Error getting alsa cards for output!');
        }

        foreach ($output as $card) {
            $card              = explode(':', $card);
            $cardArr[$card[0]] = $card[1];
        }

        return $cardArr;

    }


    /**
     * Get current timezone setting
     * @return string
     */
    public function getTimezone()
    {

        if (Storage::disk('pi')->exists('timezone')) {
            $timezone = trim(Storage::disk('pi')->get('timezone'));
            return $timezone;
        }
        return Carbon::now()->timezoneName;


    }

    /**
     * Get listing of all timezones
     *
     * @return mixed
     * @throws FPPSettingsException
     */
    public function getTimezones()
    {

        exec("find /usr/share/zoneinfo ! -type d | sed 's/\/usr\/share\/zoneinfo\///' | grep -v ^right | grep -v ^posix | grep -v ^\\/ | grep -v \\\\. | sort", $output, $return_val);

        if($return_val !=0) {
            throw new FPPSettingsException('Could not retrieve time zone listings');
        }

        $output = collect($output);
        $zones = $output->map(function($zone) {
            return [urlencode($zone) => $zone];
        })->collapse();

        return $zones;

    }

    /**
     * Get local time in friendly format
     * Format ex: Mon Feb 23 20:54:46 EST 2015
     *
     * @return string
     */
    public function getLocalTime()
    {
        return Carbon::now($this->getTimezone())->format('D M d H:i:s T Y');
    }


    /**
     * Checks if NTP is enabled
     * @return bool
     */
    public function ntpEnabled()
    {
        exec("ls -w 1 /etc/rc$(sudo runlevel | awk '{print $2}').d/ | grep ^S | grep -c ntp", $output, $return_val);
        return ($output[0] == 1);
    }
}