<?php

use App\Entity\Channel;
use App\Entity\Message;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class MessagesTest extends TestCase
{
    private User $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User('test');
    }

    public function testSuccessfulCreationOfAMessage(): void
    {
        $date = new DateTime();
        $message = new Message(content: 'test', user: $this->user, date: $date);
        $this->assertEquals('test', $message->getContent());
        $this->assertEquals($this->user, $message->getUser());
        $this->assertEquals($date, $message->getDate());
    }

    public function testMessageTooShortContent(): void
    {
        $date = new DateTime();
        $this->expectException(exception: Exception::class);
        $this->expectExceptionMessage(message: 'message is too short');
        $message = new Message(content: 't', user: $this->user, date: $date);
    }

    public function testMessageTooLongContent(): void
    {
        $date = new DateTime();
        $this->expectException(exception: Exception::class);
        $this->expectExceptionMessage(message: 'message is too long');
        $message = new Message(content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tortor pretium viverra suspendisse potenti nullam ac. Volutpat sed cras ornare arcu. Nisl condimentum id venenatis a condimentum. Ut consequat semper viverra nam libero justo laoreet sit. Id semper risus in hendrerit gravida rutrum. Tempus iaculis urna id volutpat lacus laoreet non curabitur. Dui faucibus in ornare quam viverra orci sagittis eu. Bibendum at varius vel pharetra. Curabitur vitae nunc sed velit dignissim. In hendrerit gravida rutrum quisque. Leo in vitae turpis massa sed elementum tempus egestas. Volutpat est velit egestas dui id ornare. Ac turpis egestas sed tempus urna et pharetra pharetra. Eget mauris pharetra et ultrices. Enim diam vulputate ut pharetra. Id ornare arcu odio ut sem nulla pharetra diam sit. Euismod nisi porta lorem mollis aliquam ut. Amet dictum sit amet justo donec enim diam. Mauris in aliquam sem fringilla ut morbi tincidunt. Arcu non sodales neque sodales ut etiam sit amet. Enim ut sem viverra aliquet. Velit aliquet sagittis id consectetur. Magna eget est lorem ipsum dolor. Neque sodales ut etiam sit amet nisl purus. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Auctor eu augue ut lectus arcu bibendum at. Et netus et malesuada fames ac turpis egestas. Dictumst quisque sagittis purus sit amet volutpat. Nunc faucibus a pellentesque sit. Massa tincidunt dui ut ornare lectus sit amet est. Turpis in eu mi bibendum neque egestas congue quisque. Pellentesque elit eget gravida cum sociis natoque penatibus et magnis. Elementum pulvinar etiam non quam lacus suspendisse faucibus. Ultricies leo integer malesuada nunc vel risus commodo viverra maecenas. Laoreet suspendisse interdum consectetur libero id faucibus nisl. Proin libero nunc consequat interdum varius. Dolor morbi non arcu risus quis. Nec nam aliquam sem et tortor consequat. Rhoncus urna neque viverra justo nec ultrices dui. Hac habitasse platea dictumst quisque sagittis. Habitant morbi tristique senectus et netus et.',
            user: $this->user, date: $date);
    }
}