<?php


namespace PicPay\Enqueue\Broker;


class Configuration
{
    /**
     * @var string
     */
    private $server;

    /**
     * @var string
     */
    private $port;

    public function __construct(string $server = '127.0.0.1', string $port = '9092')
    {
        $this->server = $server;
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }
}