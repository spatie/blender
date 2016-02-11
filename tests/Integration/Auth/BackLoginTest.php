<?php

namespace App\Test\Integration\Auth;

use App\Services\Auth\Back\Enums\UserStatus;
use App\Test\Integration\Concerns\UsesAuthentication;
use App\Test\Integration\TestCase;

class BackLoginTest extends TestCase
{
    use UsesAuthentication;

    /** @test */
    function it_will_redirect_protected_routes()
    {
        $this
            ->visit('/blender')
            ->seePageIs('/blender/login');
    }

    /** @test */
    function users_can_log_in()
    {
        $user = $this->createBackUser();

        $this
            ->visitBackLogin()
            ->type('user@spatie.be', 'email')
            ->type('password', 'password')
            ->press(trans('back-auth.logIn'))
            ->assertLoggedInOnBackAs($user);
    }

    /** @test */
    function logged_in_users_get_redirected_to_their_home_url()
    {
        $user = $this->createBackUser();

        $this
            ->visitBackLogin()
            ->type('user@spatie.be', 'email')
            ->type('password', 'password')
            ->press(trans('back-auth.logIn'))
            ->assertLoggedInOnBackAs($user)
            ->seePageIs('/blender');
    }

    /** @test */
    function invalid_credentials_get_rejected()
    {
        $this->createBackUser();

        $this
            ->visitBackLogin()
            ->type('user@spatie.be', 'email')
            ->type('notmypassword', 'password')
            ->press(trans('back-auth.logIn'))
            ->seePageIs('/blender/login')
            ->see(fragment('auth.failed'))
            ->assertNotLoggedInOnBack();
    }

    /** @test */
    function users_that_arent_active_yet_cannot_login()
    {
        $this->createBackUser(['status' => UserStatus::WAITING_FOR_APPROVAL()]);

        $this
            ->visitBackLogin()
            ->type('user@spatie.be', 'email')
            ->type('password', 'password')
            ->press(trans('back-auth.logIn'))
            ->seePageIs('/blender/login')
            ->see(trans('back-auth.inactiveAccountError'))
            ->assertNotLoggedInOnBack();
    }

    /** @test */
    function users_can_log_out()
    {
        $user = $this->createBackUser();

        $this
            ->actingAsOnBack($user)
            ->visitBackLogout()
            ->seePageIs('/nl')
            ->assertNotLoggedInOnBack();
    }

    /** @test */
    function logging_out_whithout_being_logged_in_is_harmless()
    {
        $this->visit('/blender/logout');
    }

    protected function visitBackLogin() : BackLoginTest
    {
        return $this->visit('/blender/login');
    }

    protected function visitBackLogout() : BackLoginTest
    {
        return $this->visit('/blender/logout');
    }
}
