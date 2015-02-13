<?php


namespace FPP;


class Collection extends \Illuminate\Support\Collection {

    public function toIni()
    {
        $output = '';
        foreach($this->items as $k => $v) {
            if(gettype($v) == 'boolean') {
                $v = (int) $v;
            }
            $output .= "$k=$v" . PHP_EOL;
        }
        return $output;
    }
}