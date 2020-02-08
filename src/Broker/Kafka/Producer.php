<?php

namespace PicPay\Enqueue\Broker\Kafka;

use PicPay\Enqueue\Broker\Contracts\ProducerInterface;

class Producer extends Client implements ProducerInterface
{
    public function produce(string $destination, array $payload): void
    {
        $client = $this->buildClient($destination);
        $client->sendEvent($destination, json_encode($payload));
    }
}