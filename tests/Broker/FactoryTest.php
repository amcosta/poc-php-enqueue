<?php


namespace Tests\Broker;


use PHPUnit\Framework\TestCase;
use PicPay\Enqueue\Broker\Configuration;
use PicPay\Enqueue\Broker\Factory;
use PicPay\Enqueue\Broker\Kafka\Client;

class FactoryTest extends TestCase
{
    public function testCreateClient()
    {
        $client = Factory::create('kafka', new Configuration('kafka1', '9092'));
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testThrowExeptionIfClassDontExist()
    {
        $this->expectException(\RuntimeException::class);
        Factory::create('naoexiste', new Configuration('kafka1', '9092'));
    }
}