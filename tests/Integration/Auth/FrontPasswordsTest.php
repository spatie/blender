<?php

namespace App\Test\Integration\Auth;

use App\Test\Integration\Concerns\UsesAuthentication;
use App\Test\Integration\Exception;
use App\Test\Integration\TestCase;
use DB;

class FrontPasswordsTest extends TestCase
{
    use UsesAuthentication;

    /** @test */
    function users_can_request_a_new_password()
    {
        $this->createFrontUser();

        $this
            ->requestResetLink()
            ->see(fragment('passwords.sent'))
            ->seeInDatabase('password_resets', ['email' => 'user@spatie.be']);
    }

    /** @test */
    function invalid_reset_links_redirect_to_the_request_page()
    {
        $this->createFrontUser();

        $this
            ->visit('/nl/password/reset/invalidlink')
            ->seePageIs('/nl/password/email');
    }

    /** @test */
    function reset_links_can_be_used_to_reset_a_password()
    {
        $user = $this->createFrontUser();

        $this
            ->requestResetLink()
            ->visit("/nl/password/reset/{$this->findTokenForEmail('user@spatie.be')}")
            ->see(fragment('auth.titleChangePassword'))
            ->assertNotLoggedInOnFront()
            ->type('user@spatie.be', 'email') // Required in the tests
            ->type('newpassword', 'password')
            ->type('newpassword', 'password_confirmation')
            ->press(fragment('auth.passwordMail.oldUser.resetButton'))
            ->assertLoggedInOnFrontAs($user);
    }

    protected function requestResetLink() : FrontPasswordsTest
    {
        return $this
            ->visit('/nl/login')
            ->click(fragment('auth.forgotPassword'))
            ->seePageIs('/nl/password/email')
            ->type('user@spatie.be', 'email')
            ->press(fragment('auth.resetPasswordButton'));
    }

    protected function findTokenForEmail(string $email) : string
    {
        $record = DB::table('password_resets', ['email' => $email])->first();

        if (empty($record)) {
            throw new Exception("No token found for email `{$email}`");
        }

        return $record->token;
    }
}
