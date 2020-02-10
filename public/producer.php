<?php

use \PicPay\Enqueue\Broker\Kafka\Producer;

require __DIR__ . "/../vendor/autoload.php";

(new Producer('kafka1:9092'))->produce('primeiro-topico', [
    '_id' => uniqid(),
    'payload' => 'Picpay'
]);
