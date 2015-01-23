<?php
namespace FPP\Services;

use Socket\Raw\Factory;

class FPPCommand {

    protected $clientPath;
    protected $socketPath;
    protected $maxTimeout;
    protected $factory;
    protected $socket;

    /**
     * @param Factory $factory
     */
    public function __construct() {
        $this->clientPath = "/tmp/FPP." . getmypid();
        $this->socketPath = "/tmp/FPPD";
        $this->maxTimeout = 1000;
        $this->factory = new Factory();
    }

    /**
     * @param $message
     * @return mixed
     */
    public function send($message) {

        $socket = $this->socket = $this->factory->createUdg();
        $socket->setBlocking(false);
        $socket->bind($this->clientPath);
        $socket->connect($this->socketPath);
        $socket->send($message, 0);
        $response = $this->receive();
        $this->cleanUp();
        return $response;
    }

    /**
     * @return mixed
     */
    protected function receive() {

        $i = 0;
        while($i < $this->maxTimeout) {
            $buffer = $this->socket->recv(1024,MSG_DONTWAIT);

            if($buffer)
                break;

            usleep(500);
        }
        return $buffer;
    }

    /**
     * Close socket and unlink client file
     */
    protected function cleanUp() {
        $this->socket->close();
        @unlink($this->clientPath);
    }


}