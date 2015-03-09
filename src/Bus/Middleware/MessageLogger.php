<?php

namespace SimpleBus\SymfonyBridge\Bus\Middleware;

use Exception;
use SimpleBus\Message\Message;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\SymfonyBridge\Logger\MessageLogger as Logger;

class MessageLogger implements MessageBusMiddleware
{
    /**
     * @var array
     */
    private $logger;

    private $busName;

    private $stageName;

    public function __construct(Logger $messageLogger, $busName, $stageName)
    {
        $this->logger = $messageLogger;
        $this->busName = $busName;
        $this->stageName = $stageName;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Message $message, callable $next)
    {
        $this->logger->logMessage($message, $this->busName, $this->stageName);

        $next($message);
    }
}
