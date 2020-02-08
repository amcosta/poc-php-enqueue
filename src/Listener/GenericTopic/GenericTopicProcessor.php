<?php


namespace PicPay\Enqueue\Listener\GenericTopic;


use Interop\Queue\Context;
use Interop\Queue\Message;
use Interop\Queue\Processor;
use PicPay\Enqueue\Broker\Exceptions\DqlException;
use PicPay\Enqueue\Broker\Exceptions\RetryException;

class GenericTopicProcessor implements Processor
{
    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function process(Message $message, Context $context)
    {
        $body = json_decode($message->getBody(), true);
        echo $message->getBody();

        throw new DqlException('qualquer coisa');

//        if (!array_key_exists('_id', $body)) {
//            echo ' - Reject' . PHP_EOL;
//            return Processor::REJECT;
//        }
//
//        if (!empty($body['requeue']) && $body['requeue'] === true) {
//            echo ' - Requeue' . PHP_EOL;
//            return Processor::REQUEUE;
//        }
//
//        if (!empty($body['exception']) && $body['exception'] === true) {
//            echo ' - Exception' . PHP_EOL;
//            throw new \Exception('Para tudo');
//        }

        echo ' - Ack' . PHP_EOL;
        return Processor::ACK;
    }
}