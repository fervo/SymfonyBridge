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

    public function __construct(Logger $messageLogger, $busName)
    {
        $this->logger = $messageLogger;
        $this->busName = $busName;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Message $message, callable $next)
    {
        $this->logger->logMessage($message, $this->busName);

        $next($message);
    }
}
