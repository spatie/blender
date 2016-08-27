<?php

namespace App\Test\Integration\Auth;

use App\Services\Auth\Front\Events\UserRegistered;
use App\Services\Auth\Front\User;
use App\Test\Integration\Concerns\UsesAuthentication;
use App\Test\Integration\TestCase;

class FrontRegisterTest extends TestCase
{
    use UsesAuthentication;

    /** @test */
    public function visitors_can_register_themselves()
    {
        $this
            ->visit('/nl/register')
            ->type('John', 'first_name')
            ->type('Doe', 'last_name')
            ->type('Samberstraat 69D', 'address')
            ->type('2060', 'postal')
            ->type('Antwerpen', 'city')
            ->type('Belgium', 'country')
            ->type('+32 3 292 56 79', 'telephone')
            ->type('info@spatie.be', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->expectsEvents(UserRegistered::class)
            ->press(fragment('auth.register'))
            ->seePageIs('/nl')
            ->seeInDatabase('users_front', ['email' => 'info@spatie.be'])
            ->assertLoggedInOnFrontAs(User::where('email', 'info@spatie.be')->first());
    }
}
