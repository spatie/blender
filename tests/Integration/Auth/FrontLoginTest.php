<?php

namespace App\Test\Integration\Auth;

use App\Services\Auth\Front\Enums\UserStatus;
use App\Test\Integration\Concerns\UsesAuthentication;
use App\Test\Integration\TestCase;

class FrontLoginTest extends TestCase
{
    use UsesAuthentication;

    function it_will_redirect_protected_routes()
    {
        // This test is only viable if the application actually has protected routes

        $this
            ->visit('/password')
            ->seePageIs('/nl/login');
    }

    /** @test */
    function users_can_log_in()
    {
        $user = $this->createFrontUser();

        $this
            ->visitFrontLogin()
            ->type('user@spatie.be', 'email')
            ->type('password', 'password')
            ->press(fragment('auth.login'))
            ->assertLoggedInOnFrontAs($user);
    }

    /** @test */
    function logged_in_users_get_redirected_to_their_home_url()
    {
        $user = $this->createFrontUser();

        $this
            ->visitFrontLogin()
            ->type('user@spatie.be', 'email')
            ->type('password', 'password')
            ->press(fragment('auth.login'))
            ->assertLoggedInOnFrontAs($user)
            ->seePageIs('/nl'); // Not using `getHomeUrl` because it depends on locale
    }

    /** @test */
    function invalid_credentials_get_rejected()
    {
        $this->createFrontUser();

        $this
            ->visitFrontLogin()
            ->type('user@spatie.be', 'email')
            ->type('notmypassword', 'password')
            ->press(fragment('auth.login'))
            ->seePageIs('/nl/login')
            ->see(fragment('auth.failed'))
            ->assertNotLoggedInOnFront();
    }

    /** @test */
    function users_that_arent_active_yet_cannot_login()
    {
        $this->createFrontUser(['status' => UserStatus::WAITING_FOR_APPROVAL()]);

        $this
            ->visitFrontLogin()
            ->type('user@spatie.be', 'email')
            ->type('password', 'password')
            ->press(fragment('auth.login'))
            ->seePageIs('/nl/login')
            ->see(fragment('auth.notActivatedError'))
            ->assertNotLoggedInOnFront();
    }

    /** @test */
    function front_users_cant_visit_blender()
    {
        $user = $this->createFrontUser();

        $this
            ->actingAsOnFront($user)
            ->assertLoggedInOnFrontAs($user)
            ->assertNotLoggedInOnBack()
            ->visit('/blender')
            ->seePageIs('/blender/login');
    }

    /** @test */
    function users_can_log_out()
    {
        $user = $this->createFrontUser();

        $this
            ->actingAsOnFront($user)
            ->visitFrontLogout()
            ->seePageIs('/nl')
            ->assertNotLoggedInOnFront();
    }

    /** @test */
    function logging_out_whithout_being_logged_in_is_harmless()
    {
        $this->visit('/nl/logout');
    }

    /** @test */
    function users_arent_logged_out_of_the_back_section_when_logging_out_of_the_front_section()
    {
        $frontUser = $this->createFrontUser();
        $backUser = $this->createBackUser();

        $this
            ->actingAsOnFront($frontUser)
            ->actingAsOnBack($backUser)
            ->visitFrontLogout()
            ->seePageIs('/nl')
            ->assertNotLoggedInOnFront()
            ->assertLoggedInOnBackAs($backUser);
    }

    protected function visitFrontLogin() : FrontLoginTest
    {
        return $this->visit('/nl/login');
    }

    protected function visitFrontLogout() : FrontLoginTest
    {
        return $this->visit('/nl/logout');
    }
}
