<?php

namespace SimpleBus\SymfonyBridge\DataCollector;

use SimpleBus\Message\Name\NamedMessage;
use SimpleBus\SymfonyBridge\Logger\MessageLogger;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageBusDataCollector extends DataCollector
{
    private $logger;

    public function __construct(MessageLogger $logger)
    {
        $this->logger = $logger;
    }

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $data = array_map(function($logEntry) {
            $message = $logEntry->getMessage();

            return [
                'bus' => $logEntry->getBusName(),
                'messageClass' => $message instanceOf NamedMessage ? $message->messageName() : get_class($message),
                'messageId' => dechex(crc32(spl_object_hash($message))),
                'timestamp' => $logEntry->getTimestamp(),
                'stage' => $logEntry->getStage(),
            ];
        }, $this->logger->getLogs());

        $this->data = array(
            'messages' => $data,
        );
    }

    public function getMessages()
    {
        return $this->data['messages'];
    }

    public function getTotalNumMessages()
    {
        return count($this->data['messages']);
    }

    public function getName()
    {
        return 'simple_bus';
    }
}
