<?php

use Enqueue\Consumption\ChainExtension;
use PicPay\Enqueue\Broker\Extensions\DlqExtension;
use PicPay\Enqueue\Broker\Extensions\RetryDlqExtension;
use PicPay\Enqueue\Broker\Kafka\Consumer;
use PicPay\Enqueue\Listener\GenericTopic\GenericTopicProcessor;

require __DIR__ . "/../vendor/autoload.php";

(new Consumer('kafka1:9092', $argv[2]))->consume(
    $argv[1],
    new GenericTopicProcessor(),
    new ChainExtension([
        new RetryDlqExtension(3, 5, 'primeiro-topico-dlq')
    ])
);
