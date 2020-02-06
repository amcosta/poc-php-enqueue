<?php

require __DIR__ . "/../vendor/autoload.php";

$client = \PicPay\Enqueue\Broker\Factory::create('kafka', new \PicPay\Enqueue\Broker\Configuration('kafka1', '9092'));

for ($i = 1; $i <= 1000; $i++) {
    $client->send('primeiro-topico', ['_id' => uniqid($i), 'payload' => 'Picpay']);
}