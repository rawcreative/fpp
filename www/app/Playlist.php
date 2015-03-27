<?php namespace FPP;

use Jenssegers\Model\Model;

class Playlist extends Model {


    protected $casts = [
                'firstOnce' => 'boolean',
                'lastOnce' => 'boolean'
                ];

    public function niceName()
    {
        return str_replace('_', ' ', $this->name);
    }

}
