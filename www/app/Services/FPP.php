<?php
namespace FPP\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use MrRio\ShellWrap as Shell;

class FPP
{
    private $command;


    function __construct(FPPCommand $command)
    {
        $this->command = $command;
    }

    public function status()
    {
        $status = $this->getStatus();

        return $this->parseStatus($status);
    }

    protected function getStatus()
    {
        return $this->command->send('s');
    }

    protected function parseStatus($status)
    {

        $status = explode(',', $status);
        $time   = Carbon::now();
        $data   = [
            'mode'        => $status[0],
            'status'      => $status[1],
            'volume'      => $status[2],
            'playlist'    => $status[3],
            'currentDate' => $time,
            'repeatMode'  => 0
        ];


        if ($data['status'] == '0' && $data['playlist'] !== 'No playlist scheduled.') {
            $data['nextPlaylistStartTime'] = $status[4];

        }

        return $data;
    }

    public function getSoundCards()
    {
        $cardArr = [];
        exec("for card in /proc/asound/card*/id; do echo -n \$card | sed 's/.*card\\([0-9]*\\).*/\\1:/g'; cat \$card; done", $output, $return_val);

        if(!$return_val)
            Log::error('Error getting alsa cards for output!');

        foreach($output as $card) {
            $card = explode(':', $card);
            $cardArr[$card[0]] = $card[1];
        }

        return $cardArr;

    }

    public function getGitBranch()
    {

        $tag = Shell::git("branch --list | grep '\\*' | awk '{print \$2}'");

        if(!$tag)
            return 'Unknown';

        return $tag;
    }

    public function getGitTag()
    {

        $tag = Shell::git('describe --tags');

        if(!$tag)
            return 'Unknown';

        return $tag;
    }


    public function getFPPDMode()
    {
        $settings = $this->getSettings();

        return $settings['fppdMode'];
    }

    public function getSettings()
    {
        if(!Cache::has('fpp_settings')) {
            if (Storage::exists(config('fpp.settings.settings_file'))) {
                $raw = Storage::get(config('fpp.settings.settings_file'));
                $settings = $this->parseSettings($raw);
                Cache::put('fpp_settings', $settings);
                return $settings;
            }
            return config('fpp.settings.defaults');

        }
        return Cache::get('fpp_settings');

    }

    protected function parseSettings($data)
    {
        $parsed = [];
        $rows = explode("\n", $data);

        foreach($rows as $row) {

            $rowData = explode('=', $row);
            $parsed[trim($row[0])] = trim($row[1]);
        }

        return $parsed;
    }
}