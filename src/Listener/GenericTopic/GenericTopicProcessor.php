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
        $info = [
            'message_id' => $message->getMessageId(),
            'headers' => $message->getHeaders(),
            'payload' => json_decode($message->getBody(), true)
        ];

//        throw new RetryException('qualquer coisa');
//        throw new DqlException('qualquer coisa');

        echo $message->getMessageId() . ' - Ack' . PHP_EOL;
        return Processor::ACK;
    }
}