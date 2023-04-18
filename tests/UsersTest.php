<?php

use App\Entity\User;
use App\Entity\App;
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    private App $app;

    public function setUp(): void
    {
        $this->app = new App();
        parent::setUp();
    }

    public function testSuccessfulCreationOfAUser(): void
    {
        $user = new User('test');
        $this->app->addUser($user);
        $addedUser = $this->app->getUsers()[0];
        $this->assertEquals($user, $addedUser);
    }

    public function testUserHasntCorrectUserName(): void
    {
        $this->expectException(exception: Exception::class);
        $this->expectExceptionMessage(message: 'User should have a valid name');
        $user = new User('');
    }

    public function testUserAlreadyExistsInApp(): void
    {
        $this->expectException(exception: Exception::class);
        $this->expectExceptionMessage(message: 'User already exists');
        $user1 = new User('test');
        $this->app->addUser($user1);
        $user2 = new User('test');
        $this->app->addUser($user2);
    }
}