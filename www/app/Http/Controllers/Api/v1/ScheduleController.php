<?php namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Requests;
use FPP\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ScheduleController extends Controller
{


    public function getSchedule()
    {
        if (Storage::disk('pi')->exists("schedule")) {

            $csv = Reader::createFromPath(config('fpp.schedule'));

            $entries = $csv->fetchAssoc([
                'enabled',
                'playlist',
                'startDay',
                'startHour',
                'startMinute',
                'startSecond',
                'endHour',
                'endMinute',
                'endSecond',
                'repeat',
                'startDate',
                'endDate',
            ]);

            return response()->json([
                'response' => [
                    'schedule' => [
                         'entries'    => $entries
                    ]
                ]
            ]);
        }
    }
}
