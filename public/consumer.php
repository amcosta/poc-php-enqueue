<?php

use Enqueue\Consumption\ChainExtension;
use PicPay\Enqueue\Broker\Extensions\DlqExtension;
use PicPay\Enqueue\Broker\Extensions\RetryExtension;
use PicPay\Enqueue\Broker\Kafka\Consumer;
use PicPay\Enqueue\Listener\GenericTopic\GenericTopicProcessor;

require __DIR__ . "/../vendor/autoload.php";

(new Consumer('kafka://kafka1:9092'))->consume(
    'primeiro-topico',
    new GenericTopicProcessor(),
    new ChainExtension([
        new RetryExtension(3, 5),
        new DlqExtension('primeiro-topico-dlq')
    ])
);

