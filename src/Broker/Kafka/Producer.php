<?php


namespace PicPay\Enqueue\Broker\Kafka;


use Interop\Queue\Destination;
use Interop\Queue\Exception;
use Interop\Queue\Exception\DeliveryDelayNotSupportedException;
use Interop\Queue\Exception\InvalidDestinationException;
use Interop\Queue\Exception\InvalidMessageException;
use Interop\Queue\Exception\PriorityNotSupportedException;
use Interop\Queue\Exception\TimeToLiveNotSupportedException;
use Interop\Queue\Message;

class Producer implements \Interop\Queue\Producer
{
    private $source;

    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function send(Destination $destination, Message $message): void
    {
        // TODO: Implement send() method.
    }

    /**
     * @inheritDoc
     */
    public function setDeliveryDelay(int $deliveryDelay = null): \Interop\Queue\Producer
    {
        // TODO: Implement setDeliveryDelay() method.
    }

    /**
     * @inheritDoc
     */
    public function getDeliveryDelay(): ?int
    {
        // TODO: Implement getDeliveryDelay() method.
    }

    /**
     * @inheritDoc
     */
    public function setPriority(int $priority = null): \Interop\Queue\Producer
    {
        // TODO: Implement setPriority() method.
    }

    /**
     * @inheritDoc
     */
    public function getPriority(): ?int
    {
        // TODO: Implement getPriority() method.
    }

    /**
     * @inheritDoc
     */
    public function setTimeToLive(int $timeToLive = null): \Interop\Queue\Producer
    {
        // TODO: Implement setTimeToLive() method.
    }

    /**
     * @inheritDoc
     */
    public function getTimeToLive(): ?int
    {
        // TODO: Implement getTimeToLive() method.
    }
}