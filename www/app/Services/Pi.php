<?php


namespace FPP\Services;


use Carbon\Carbon;
use FPP\Exceptions\FPPSettingsException;
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
     * Checks if NTP is enabled
     * @return bool
     */
    public function ntpEnabled()
    {
        exec("ls -w 1 /etc/rc$(sudo runlevel | awk '{print $2}').d/ | grep ^S | grep -c ntp", $output, $return_val);
        return ($output[0] == 1);
    }
}