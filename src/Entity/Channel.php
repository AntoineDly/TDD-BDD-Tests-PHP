<?php

namespace App\Entity;

use Exception;

class Channel
{
    private string $name;
    private array $messages;

    public function __construct()
    {
        $this->messages = [];
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        foreach ($this->messages as $currentAddMessage) {
            if ($message->getUser() === end($this->messages)->getUser() &&
                $currentAddMessage->getUser() === $message->getUser() &&
                $message->getDate()->diff($currentAddMessage->getDate())->format('%d') == 0
            ) {
                throw new Exception('you have already sent a message in the last 24 hours');
            }
        }
        $this->messages[] = $message;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Channel
    {
        $this->name = $name;
        return $this;
    }
}