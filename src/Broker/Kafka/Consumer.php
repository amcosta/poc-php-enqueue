<?php

namespace PicPay\Enqueue\Broker\Kafka;

use Enqueue\Consumption\ExtensionInterface;
use Interop\Queue\Processor;
use PicPay\Enqueue\Broker\Contracts\ConsumerInterface;

class Consumer extends Client implements ConsumerInterface
{
    public function consume(string $destination, Processor $processor, ExtensionInterface $extension = null)
    {
        $client = $this->buildClient($destination);
        $client->bindTopic($destination, $processor);
        $client->consume($extension);
    }
}