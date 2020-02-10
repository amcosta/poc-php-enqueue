<?php

namespace PicPay\Enqueue\Broker\Kafka;

use Enqueue\SimpleClient\SimpleClient;
use PicPay\Enqueue\Broker\Contracts\ProducerInterface;

class Producer extends Client implements ProducerInterface
{
    public function produce(string $destination, array $payload): void
    {
        $client = $this->buildClient($destination);
        $client->sendEvent($destination, json_encode($payload));
    }

    protected function buildClient(string $topic)
    {
        return new SimpleClient([
            'transport' => 'kafka://' . $this->dsn,
            'client' => [
                'prefix' => '',
                'app_name' => '',
                'router_topic' => $topic,
                'router_queue' => $topic,
                'default_queue' => $topic
            ]
        ]);
    }
}