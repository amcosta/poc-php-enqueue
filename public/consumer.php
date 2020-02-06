<?php

require __DIR__ . "/../vendor/autoload.php";

$client = \PicPay\Enqueue\Broker\Factory::create('kafka', new \PicPay\Enqueue\Broker\Configuration('kafka1', '9092'));

do {
    $message = $client->receive('primeiro-topico');
    var_dump($message);
} while (true);