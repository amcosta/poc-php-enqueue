<?php


namespace PicPay\Enqueue\Broker;

use Interop\Queue\Consumer;
use Interop\Queue\Context;
use Interop\Queue\Producer;

interface ClientInterface extends ConsumerInterface, ProducerInterface
{
    public function getContext(): Context;

    public function getConsumer(string $destination): Consumer;

    public function getProducer(): Producer;
}