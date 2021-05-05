<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpKernel\KernelInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Exception;

class Feedback implements EventSubscriber
{
    public function __construct(private KernelInterface $kernel, private BotApi $telegramBot, private int $chatId)
    {}

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    protected function sendMessage(string $text): void
    {
        if (PHP_SAPI === 'cli' || $this->kernel->getEnvironment() !== 'prod') {
            return;
        }

        $retries = 3;
        $message = null;
        do {
            try {
                $message = $this->telegramBot->sendMessage($this->chatId, $text);
            } catch (Exception) {}
        } while ((!$message || !$message->getMessageId()) && --$retries > 0);
    }

    private function updateFeedback(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof \App\Entity\Feedback) {
            return;
        }

        $this->sendMessage($entity->__toString());
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->updateFeedback($args);
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->updateFeedback($args);
    }
}
