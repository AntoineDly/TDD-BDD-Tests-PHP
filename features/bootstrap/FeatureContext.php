<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use App\Entity\Channel;
use App\Entity\Message;
use App\Entity\User;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private User $user;
    private Channel $channel;
    private Channel $otherChannel;
    private Exception $exception;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->user = new User('test');
        $this->channel = new Channel('channel');
        $this->otherChannel = new Channel('other channel');
    }

    /**
     * @Given the user is connected to the channel
     */
    public function theUserIsConnectedToTheChannel()
    {
        $this->user->setChannel($this->channel);
    }

    /**
     * @Given he has added a message in the last :arg1 hours;
     */
    public function heHasAddAMessageInTheLastHours($arg1)
    {
        try {
            $this->channel->addMessage(new Message(content: 'message before 24 hours', user: $this->user, date: new DateTime('-23 hours -59 minutes')));
        } catch (Exception $exception) {
            $this->exception = $exception;
        }
    }

    /**
     * @Given another user has added a message in the last :arg1 hours;
     */
    public function anotherUserHasAddedAMessageInTheLastHours($arg1)
    {
        try {
            $this->channel->addMessage(new Message(content: 'message before 24 hours', user: new User('test'), date: new DateTime('-23 hours -59 minutes')));
        } catch (Exception $exception) {
            $this->exception = $exception;
        }
    }


    /**
     * @When I add a message :message in the channel
     */
    public function iAddAMessageInTheChannel($message)
    {
        try {
            $this->channel->addMessage(new Message(content: $message, user: $this->user, date: new DateTime()));
        } catch (Exception $exception) {
            $this->exception = $exception;
        }
    }

    /**
     * @Then :arg1 message should be registered in the channel
     */
    public function messageShouldBeRegisteredInTheChannel($arg1)
    {
        Assert::assertCount($arg1, $this->channel->getMessages());
    }

    /**
     * @Then it should return the error :errorMessage
     */
    public function itShouldReturnAnError($errorMessage)
    {
        Assert::assertEquals(0, $this->exception->getCode());
        Assert::assertEquals($errorMessage, $this->exception->getMessage());
    }

    /**
     * @Given he is connected to another channel :arg1
     */
    public function heIsConnectedToAnotherChannel($arg1)
    {
        $this->user->setChannel($this->otherChannel->setName($arg1));
    }

    /**
     * @When I add a message :arg1 in the new channel
     */
    public function iAddAMessageInTheNewChannel($arg1)
    {
        try {
            $this->otherChannel->addMessage(new Message(content: $arg1, user: $this->user, date: new DateTime()));
        } catch (Exception $exception) {
            $this->exception = $exception;
        }
    }

    /**
     * @Then :arg1 message should be registered in the new channel
     */
    public function messageShouldBeRegisteredInTheNewChannel($arg1)
    {
        Assert::assertCount($arg1, $this->otherChannel->getMessages());
    }
}
