<?php
namespace FPP\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
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
            $cardArr[$card[1]] = $card[0];
        }

        return $cardArr;

    }


}