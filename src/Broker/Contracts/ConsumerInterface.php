<?php


namespace PicPay\Enqueue\Broker\Contracts;

use Interop\Queue\Processor;

interface ConsumerInterface
{
    public function consume(string $destination, Processor $processor);
}