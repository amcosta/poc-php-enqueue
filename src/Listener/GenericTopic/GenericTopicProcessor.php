<?php


namespace PicPay\Enqueue\Listener\GenericTopic;


use Interop\Queue\Context;
use Interop\Queue\Message;
use Interop\Queue\Processor;

class GenericTopicProcessor implements Processor
{
    /**
     * @inheritDoc
     */
    public function process(Message $message, Context $context)
    {
        $body = json_decode($message->getBody(), true);
        echo $message->getBody();

        if (!array_key_exists('_id', $body)) {
            echo ' - Reject' . PHP_EOL;
            return Processor::REJECT;
        }

        if (!empty($body['requeue']) && $body['requeue']) {
            echo ' - Requeue' . PHP_EOL;
            return Processor::REQUEUE;
        }

        echo ' - Ack' . PHP_EOL;
        return Processor::ACK;
    }
}