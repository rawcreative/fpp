<?php
namespace FPP\Services;


use Carbon\Carbon;

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


}