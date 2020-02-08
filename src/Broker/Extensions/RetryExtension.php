<?php


namespace PicPay\Enqueue\Broker\Extensions;


use Enqueue\Consumption\Context\End;
use Enqueue\Consumption\Context\InitLogger;
use Enqueue\Consumption\Context\MessageReceived;
use Enqueue\Consumption\Context\MessageResult;
use Enqueue\Consumption\Context\PostConsume;
use Enqueue\Consumption\Context\PostMessageReceived;
use Enqueue\Consumption\Context\PreConsume;
use Enqueue\Consumption\Context\PreSubscribe;
use Enqueue\Consumption\Context\ProcessorException;
use Enqueue\Consumption\Context\Start;
use Enqueue\Consumption\ExtensionInterface;
use Enqueue\Consumption\Result;
use PicPay\Enqueue\Broker\Exceptions\RetryException;

class RetryExtension implements ExtensionInterface
{
    /**
     * @var int
     */
    private $interval;

    /**
     * @var int
     */
    private $attempts;

    public function __construct(int $attempts = 1, int $interval = 0)
    {
        $this->attempts = $attempts;;
        $this->interval = $interval;
    }

    /**
     * @inheritDoc
     */
    public function onEnd(End $context): void
    {
        // TODO: Implement onEnd() method.
    }

    /**
     * @inheritDoc
     */
    public function onInitLogger(InitLogger $context): void
    {
        // TODO: Implement onInitLogger() method.
    }

    /**
     * @inheritDoc
     */
    public function onMessageReceived(MessageReceived $context): void
    {
        // TODO: Implement onMessageReceived() method.
    }

    /**
     * @inheritDoc
     */
    public function onResult(MessageResult $context): void
    {
        // TODO: Implement onResult() method.
    }

    /**
     * @inheritDoc
     */
    public function onPostConsume(PostConsume $context): void
    {
        // TODO: Implement onPostConsume() method.
    }

    /**
     * @inheritDoc
     */
    public function onPostMessageReceived(PostMessageReceived $context): void
    {
        // TODO: Implement onPostMessageReceived() method.
    }

    /**
     * @inheritDoc
     */
    public function onPreConsume(PreConsume $context): void
    {
        // TODO: Implement onPreConsume() method.
    }

    /**
     * @inheritDoc
     */
    public function onPreSubscribe(PreSubscribe $context): void
    {
        // TODO: Implement onPreSubscribe() method.
    }

    /**
     * @inheritDoc
     */
    public function onProcessorException(ProcessorException $handler): void
    {
        if (!$handler->getException() instanceof RetryException) {
            return;
        }

        if ($this->attempts < 1) {
            return;
        }

        $message = $handler->getMessage();
        $currentAttempt = $message->getHeader('current_attempt', 1);
        echo 'Tentativa: ' . $currentAttempt . PHP_EOL;

        if ($currentAttempt > $this->attempts) {
            $handler->setResult(Result::reject($handler->getException()->getMessage()));
            return;
        }

        sleep($this->interval);
        $message->setHeader('current_attempt', ($currentAttempt + 1));
        $handler->setResult(Result::requeue('This message don\'t exceeded the attempts remaining'));
    }

    /**
     * @inheritDoc
     */
    public function onStart(Start $context): void
    {
        // TODO: Implement onStart() method.
    }
}