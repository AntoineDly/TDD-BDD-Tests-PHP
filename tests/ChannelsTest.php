<?php

use App\Entity\Channel;
use App\Entity\App;
use PHPUnit\Framework\TestCase;

class ChannelsTest extends TestCase
{
    private App $app;

    public function setUp(): void
    {
        $this->app = new App();
        parent::setUp();
    }

    public function testSuccessfulCreationOfAChannel(): void
    {
        $channel = new Channel('test');
        $this->app->addChannel($channel);
        $addedChannel = $this->app->getchannels()[0];
        $this->assertEquals($channel, $addedChannel);
    }

    public function testChannelHasntCorrectChannelName(): void
    {
        $this->expectException(exception: Exception::class);
        $this->expectExceptionMessage(message: 'Channel should have a valid name');
        $channel = new Channel('');
    }

    public function testchannelAlreadyExistsInApp(): void
    {
        $this->expectException(exception: Exception::class);
        $this->expectExceptionMessage(message: 'Channel already exists');
        $channel1 = new Channel('test');
        $this->app->addChannel($channel1);
        $channel2 = new Channel('test');
        $this->app->addChannel($channel2);
    }
}