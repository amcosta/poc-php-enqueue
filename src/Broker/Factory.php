<?php


namespace PicPay\Enqueue\Broker;


class Factory
{
    public static function create(string $broker, Configuration $config): ClientInterface
    {
        $broker = ucfirst(strtolower($broker));
        $classname = "PicPay\\Enqueue\\Broker\\$broker\\Client";

        if (!class_exists($classname)) {
            throw new \RuntimeException(sprintf("classe %s não existe", $classname));
        }

        return new $classname($config);
    }
}