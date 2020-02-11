<?php

namespace PicPay\Enqueue\Broker\Kafka;

use Enqueue\Consumption\ExtensionInterface;
use Enqueue\Consumption\QueueConsumer;
use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Interop\Queue\Processor;
use PicPay\Enqueue\Broker\Contracts\ConsumerInterface;

class Consumer extends Client implements ConsumerInterface
{
    /**
     * @var string
     */
    private $groupId;

    public function __construct(string $dsn, string $groupId)
    {
        parent::__construct($dsn);
        $this->groupId = $groupId;
    }

    /**
     * @throws \Exception
     */
    public function consume(string $destination, Processor $processor, ExtensionInterface $extension = null)
    {
        $context = $this->buildClient($destination)->createContext();
        $queueConsumer = new QueueConsumer($context, $extension);
        $queueConsumer->bind($destination, $processor);
        $queueConsumer->consume();
    }

    protected function buildClient(string $topic)
    {
        return new RdKafkaConnectionFactory([
            'global' => [
                'group.id' => $this->groupId,
                'metadata.broker.list' => $this->dsn,
                'offset.store.method' => 'broker'
            ]
        ]);
    }
}