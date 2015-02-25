<?php
namespace FPP\Services;


use Carbon\Carbon;
use FPP\Exceptions\FPPSettingsException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Socket\Raw\Exception;

class FPP
{
    private $command;
    private $modes;

    function __construct(FPPCommand $command)
    {
        $this->command = $command;
        $this->modes   = new Collection([
            '0' => 'unknown',
            '1' => 'bridge',
            '2' => 'player',
            '6' => 'master',
            '8' => 'remote'
        ]);
    }

    public function status()
    {
        try {
            $status = $this->getStatus();

            return $this->parseStatus($status);
        } catch (Exception $e) {
            return ['fppd' => 'stopped'];
        }

    }

    protected function getStatus()
    {
        return $this->command->send('s');
    }


    protected function parseStatus($status)
    {

        $status = explode(',', $status);
        $time   = \Pi::getLocalTime();

        $data = [
            'fppd'        => 'running',
            'mode'        => $this->parseFPPDMode($status[0]),
            'status'      => (int)$status[1],
            'volume'      => (int)$status[2],
            'playlist'    => $status[3],
            'currentDate' => $time,
            'repeatMode'  => 0
        ];


        if ($data['status'] == '0' && $data['playlist'] !== 'No playlist scheduled.') {
            $data['nextPlaylistStartTime'] = $status[4];

        }

        return $data;
    }

    /**
     * Parse mode integer into a user recognizable string
     *
     * @param $mode
     * @return mixed
     */
    public function parseFPPDMode($mode)
    {
        return $this->modes->get($mode, 'player');
    }

    /**
     * Check if FPPD is currently running
     *
     * @return bool
     */
    public function isFPPDRunning()
    {
        $status = exec("if ps cax | grep -q fppd; then echo \"true\"; else echo \"false\"; fi");
        return ($status === 'true');
    }

    /**
     * Return current fppd mode
     *
     * @return string
     */
    public function getFPPDMode()
    {
        $settings = $this->getSettings();

        return $settings['fppdMode'];
    }

    /**
     * Retrieve all settings in the fpp settings file in array format
     *
     * @return array|mixed
     */
    public function getSettings()
    {

        if (Storage::disk('pi')->exists('settings')) {
            $raw = Storage::disk('pi')->get('settings');
//            $settings = $this->parseSettings($raw);
            $settings = parse_ini_string($raw);

            $settings = array_merge(config('fpp.settings.defaults'), $settings);
            return $settings;
        }
        return config('fpp.settings.defaults');

    }

    /**
     * Retrieve specified setting from fpp settings file
     *
     * @param $setting
     * @return mixed
     */
    public function getSetting($setting)
    {
        $settings = collect($this->getSettings());

        return $settings->get($setting, function () {
            throw new FPPSettingsException('FPP Setting Not Found!');
        });
    }

    /**
     * Internal method to parse raw settings file data
     *
     * @param $data
     * @return array
     */
    protected function parseSettings($data)
    {
        $parsed = [];
        $rows   = explode("\n", $data);

        foreach ($rows as $row) {

            $rowData               = explode('=', $row);
            $parsed[trim($row[0])] = trim($row[1]);
        }

        return $parsed;
    }

    /**
     * Gather and return playlists
     *
     * @return array
     */
    public function getPlaylists()
    {
        return array_values(array_filter(scandir(fpp_media('playlists')), function ($file) {
            return $file != '.' && $file != '..';
        }));
    }

    /**
     * Return playlist data
     *
     * @param $playlist
     * @return array|bool
     */
    public function getPlaylist($playlist)
    {
        if (Storage::disk('pi')->exists("playlists/$playlist")) {
            $csv       = Reader::createFromPath(trailingslashit(fpp_media('playlists')) . $playlist);
            $firstLast = $csv->fetchOne();
            $entries   = $csv->setOffset(1)->fetchAssoc(['type', 'sequence', 'media']);

            return [
                    'name'       => $playlist,
                    'first_once' => $firstLast[0],
                    'last_once'  => $firstLast[1],
                    'entries'    => $entries
              ];
        }

        return false;
    }

    public function getVolume()
    {
        return $this->getSetting('volume');
    }


}