<?php

use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\User;

class FrontUserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_is_initializable()
    {
        $this->assertInstanceOf(User::class, new User());
    }

    /** @test */
    public function it_has_a_status()
    {
        $user = new User([
            'status' => UserStatus::WAITING_FOR_APPROVAL(),
        ]);

        $this->assertInstanceOf(UserStatus::class, $user->status);
        $this->assertTrue($user->hasStatus(UserStatus::WAITING_FOR_APPROVAL()));

        $user->status = UserStatus::ACTIVE();

        $this->assertInstanceOf(UserStatus::class, $user->status);
        $this->assertTrue($user->hasStatus(UserStatus::ACTIVE()));
    }

    /** @test */
    public function it_can_be_activated()
    {
        $user = new User([
            'status' => UserStatus::WAITING_FOR_APPROVAL(),
        ]);

        $user->activate();

        $this->assertEquals(UserStatus::ACTIVE, $user->status->getValue());
    }

    /** @test */
    public function it_has_a_role()
    {
        $user = new User([
            'role' => UserRole::MEMBER(),
        ]);

        $this->assertInstanceOf(UserRole::class, $user->role);
        $this->assertEquals(UserRole::MEMBER, $user->role->getValue());
        $this->assertTrue($user->hasRole(UserRole::MEMBER()));
    }
}
