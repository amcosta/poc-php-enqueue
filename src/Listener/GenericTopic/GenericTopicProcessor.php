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
        $payload = json_decode($message->getBody(), true);
        $magicNumber = $payload['execution_time'];

        $info = [
            'message_id' => $message->getMessageId(),
            'random_number' => $magicNumber
        ];

        if ($magicNumber > 23) {
            $info['exception'] = DqlException::class;
            $this->print($info);
            throw new DqlException('Mensgaem movida para a DLQ');
        }

        if ($magicNumber < 5) {
            $info['exception'] = RetryException::class;
            $this->print($info);
            throw new RetryException('Houve um problema, vamos tentar mais uma vez!');
        }

        $this->print($info);
        sleep($magicNumber);
        return Processor::ACK;
    }

    private function print($msg)
    {
        $string = json_encode($msg, JSON_PRETTY_PRINT);
        $string.= PHP_EOL;
        fwrite(STDOUT, $string);
    }
}