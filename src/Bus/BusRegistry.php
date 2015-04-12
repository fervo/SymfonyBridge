<?php

namespace SimpleBus\SymfonyBridge\Bus;

use SimpleBus\Message\Bus\MessageBus;

class BusRegistry
{
    private $buses = [];

    public function addBus($name, MessageBus $bus)
    {
        $this->buses[$name] = $bus;
    }

    public function all()
    {
        return $this->buses;
    }
}
