<?php

namespace PicPay\Enqueue\Broker\Kafka;

use Enqueue\SimpleClient\SimpleClient;

abstract class Client
{
    /**
     * @var string
     */
    protected $dsn;

    public function __construct(string $dsn)
    {
        $this->dsn = $dsn;
    }

    abstract protected function buildClient(string $topic);
}