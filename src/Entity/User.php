<?php

namespace App\Entity;

use Exception;

class User
{
    private string $userName;

    public function __construct(string $userName)
    {
        $this->setUserName($userName);
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): User
    {
        if ($userName === '') {
            throw new Exception('User should have a valid name');
        }
        $this->userName = $userName;
        return $this;
    }

    private Channel $channel;

    public function getChannel(): Channel
    {
        return $this->channel;
    }

    public function setChannel(Channel $channel): self
    {
        $this->channel = $channel;
        return $this;
    }
}