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
use Interop\Queue\Processor;
use PicPay\Enqueue\Broker\Exceptions\DqlException;

class DlqExtension implements ExtensionInterface
{
    /**
     * @var string
     */
    private $topicName;

    public function __construct(string $topicName)
    {
        $this->topicName = $topicName;
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
        if (!$handler->getException() instanceof DqlException) {
            return;
        }

        $context = $handler->getContext();

        $message = $handler->getMessage();
        $message->setHeader('exception', $handler->getException()->getMessage());

        $context->createProducer()->send(
            $context->createTopic($this->topicName),
            $message
        );

        $handler->setResult(Result::reject(sprintf('Message moved to %s topic', $this->topicName)));
    }

    /**
     * @inheritDoc
     */
    public function onStart(Start $context): void
    {
        // TODO: Implement onStart() method.
    }
}