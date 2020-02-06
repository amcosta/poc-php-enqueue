<?php


namespace PicPay\Enqueue\Broker;


interface ConsumerInterface
{
    public function receive(string $destination);
}