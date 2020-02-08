<?php


namespace PicPay\Enqueue\Broker\Contracts;


interface ProducerInterface
{
    public function produce(string $destination, array $payload): void;
}