<?php

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Interop\Queue\Message;
use Interop\Queue\Processor;

require __DIR__ . "/../vendor/autoload.php";

$conn = new RdKafkaConnectionFactory([
    'global' => [
        'group.id' => 'php-enqueue',
        'metadata.broker.list' => 'kafka1:9092',
        'enable.auto.commit' => 'false',
    ]
]);

$topicName = 'primeiro-topico';

$context = $conn->createContext();
$topic = $context->createTopic($topicName);
$consumer = $context->createConsumer($topic);

$queueConsumer = new \Enqueue\Consumption\QueueConsumer($context);
$queueConsumer->bind($topic, new \PicPay\Enqueue\Listener\GenericTopic\GenericTopicProcessor());
$queueConsumer->consume();
