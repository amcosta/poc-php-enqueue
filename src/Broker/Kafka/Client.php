<?php


namespace PicPay\Enqueue\Broker\Kafka;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Interop\Queue\Consumer;
use Interop\Queue\Context;
use Interop\Queue\Producer;
use PicPay\Enqueue\Broker\ClientInterface;
use PicPay\Enqueue\Broker\Configuration;

class Client implements ClientInterface
{
    private $client;

    public function __construct(Configuration $config)
    {
        $server = $config->getServer() . ":" . $config->getPort();
        $this->client = new RdKafkaConnectionFactory([
            'global' => [
                'group.id' => 'php-enqueue',
                'metadata.broker.list' => $server,
                'enable.auto.commit' => 'false',
            ]
        ]);
    }

    public function receive(string $destination)
    {
        $context = $this->client->createContext();
        return $context->createConsumer($context->createTopic($destination))->receive();
    }

    public function send(string $destination, array $data)
    {
        $context = $this->client->createContext();
        $context->createProducer()->send(
            $context->createTopic($destination),
            $context->createMessage(json_encode($data))
        );
    }

    public function remove($message, $destination)
    {
        $context = $this->client->createContext();
        $context->createConsumer($context->createTopic($destination))->acknowledge($message);
    }

    public function getConsumer(string $destination): Consumer
    {
        $context = $this->client->createContext();
        return $context->createConsumer($context->createTopic($destination));
    }

    public function getProducer(): Producer
    {
        return $this->client->createContext()->createProducer();
    }

    public function getContext(): Context
    {
        return $this->client->createContext();
    }
}