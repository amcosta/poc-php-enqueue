<?php

use Enqueue\RdKafka\RdKafkaConnectionFactory;

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

$queueConsumer = new \Enqueue\Consumption\QueueConsumer(
    $context,
    new \Enqueue\Consumption\ChainExtension([
        new \PicPay\Enqueue\Broker\Extensions\RetryExtension(3, 5),
        new \PicPay\Enqueue\Broker\Extensions\DlqExtension('primeiro-topico-dlq')
    ])
);
$queueConsumer->bind($topic, new \PicPay\Enqueue\Listener\GenericTopic\GenericTopicProcessor());
$queueConsumer->consume();
