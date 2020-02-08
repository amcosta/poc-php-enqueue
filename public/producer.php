<?php

use Enqueue\RdKafka\RdKafkaConnectionFactory;

require __DIR__ . "/../vendor/autoload.php";

//$client = \PicPay\Enqueue\Broker\Factory::create('kafka', new \PicPay\Enqueue\Broker\Configuration('kafka1', '9092'));
//
//
//for ($i = 1; $i <= 1000; $i++) {
//    $client->send('primeiro-topico', ['_id' => uniqid($i), 'payload' => 'Picpay']);
//}

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
$message = $context->createMessage(json_encode([
    '_id' => uniqid(),
    'payload' => 'Picpay',
    'exception' => false,
    'requeue' => false
]));

//for ($i = 1; $i <= 100; $i++) {
    $context->createProducer()->send($topic, $message);
//}