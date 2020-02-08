<?php

namespace PicPay\Enqueue\Broker\Kafka;

use Enqueue\SimpleClient\SimpleClient;

class Client
{
    /**
     * @var SimpleClient
     */
    protected $client;

    /**
     * @var string
     */
    private $dsn;

    public function __construct(string $dsn)
    {
        $this->dsn = $dsn;
    }

    protected function buildClient(string $topic)
    {
        return new SimpleClient([
            'transport' => $this->dsn,
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