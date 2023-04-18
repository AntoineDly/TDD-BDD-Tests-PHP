<?php

namespace App\Entity;

use App\Entity\Channel;
use App\Entity\User;
use Exception;

class App
{
    private array $channels;
    private array $users;

    public function __construct()
    {
        $this->channels = [];
        $this->users = [];
    }

    public function getChannels(): array
    {
        return $this->channels;
    }

    public function addChannel(Channel $channel): self
    {
        foreach ($this->channels as $currentChannel) {
            if ($currentChannel->getName() === $channel->getName()) {
                throw new Exception('Channel already exists');
            }
        }
        $this->channels[] = $channel;
        return $this;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        foreach ($this->users as $currentUser) {
            if ($currentUser->getUserName() === $user->getUserName()) {
                throw new Exception('User already exists');
            }
        }
        $this->users[] = $user;
        return $this;
    }

}