<?php


namespace PicPay\Enqueue\Broker\Kafka;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
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
}