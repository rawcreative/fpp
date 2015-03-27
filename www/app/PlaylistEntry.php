<?php namespace FPP;


use Jenssegers\Model\Model;

class PlaylistEntry extends Model
{

    public $type;
    public $sequence;
    public $media;

    public function getTypeAttribute($value)
    {
        return $this->mapType($value);
    }

    public function mapType($type)
    {
        $types = [
            'b' => 'Media and Sequence',
            'm' => 'Media Only',
            's' => 'Sequence Only',
            'p' => 'Pause',
            'e' => 'Event',
            'P' => 'Plugin'
        ];

        return $types[$type];
    }
}
