<?php

namespace SimpleBus\SymfonyBridge\Logger;

use DateTime;
use SimpleBus\Message\Message;

class LogEntry
{
    private $message;
    private $busName;
    private $stage;
    private $timestamp;

    public function __construct(Message $message, $busName, $stage)
    {
        $this->message = $message;
        $this->busName = $busName;
        $this->stage = $stage;
        $this->timestamp = microtime(true);
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getBusName()
    {
        return $this->busName;
    }

    public function getStage()
    {
        return $this->stage;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
