<?php


namespace PicPay\Enqueue\Broker;


interface ProducerInterface
{
    public function send(string $destination, array $data);
}