<?php


namespace Tests\Broker\Kafka;


use PHPUnit\Framework\TestCase;
use PicPay\Enqueue\Broker\Configuration;
use PicPay\Enqueue\Broker\Factory;

class ClientTest extends TestCase
{
    /**
     * @var Configuration
     */
    private $config;

    public function setUp(): void
    {
        $this->config = new Configuration('kafka1', '9092');
    }

    public function testSendMessage()
    {
        $client = Factory::create('kafka', $this->config);
        $client->send('primeiro-topico', ['company' => 'Picpay!!!']);
    }
}