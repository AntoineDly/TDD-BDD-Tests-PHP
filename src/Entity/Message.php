<?php

namespace App\Entity;

use DateTime;
use Exception;

class Message
{
    private int $channel;
    private string $content;
    private User $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): Message
    {
        $this->user = $user;
        return $this;
    }
    private DateTime $date;

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): Message
    {
        $this->date = $date;
        return $this;
    }

    public function getChannel(): int
    {
        return $this->channel;
    }

    public function setChannel(int $channel): self
    {
        $this->channel = $channel;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        if(strlen($content) < 2) {
            throw new Exception('message is too short');
        }

        if(strlen($content) > 2048) {
            throw new Exception('message is too long');
        }

        $this->content = $content;
        return $this;
    }
}