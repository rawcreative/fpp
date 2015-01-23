<?php


namespace FPP\Services;




class FPP {


    public function status() {
        return $this->getStatus();
    }

    protected function getStatus() {
        $command = new FPPCommand();
        return $command->send('s');
    }

    protected function parseStatus($status) {}


}