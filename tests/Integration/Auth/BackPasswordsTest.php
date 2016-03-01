<?php

namespace App\Test\Integration\Auth;

use App\Test\Integration\Concerns\UsesAuthentication;
use App\Test\Integration\Exception;
use App\Test\Integration\TestCase;
use DB;

class BackPasswordsTest extends TestCase
{
    use UsesAuthentication;

    /** @test */
    function users_can_request_a_new_password()
    {
        $this->createBackUser();

        $this
            ->requestResetLink()
            ->see(fragment('passwords.sent'))
            ->seeInDatabase('password_resets', ['email' => 'user@spatie.be']);
    }

    /** @test */
    function invalid_reset_links_redirect_to_the_request_page()
    {
        $this->createBackUser();

        $this
            ->visit('/blender/password/reset/invalidlink')
            ->seePageIs('/blender/password/email');
    }

    /** @test */
    function reset_links_can_be_used_to_reset_a_password()
    {
        $user = $this->createBackUser();

        $this
            ->requestResetLink()
            ->visit("/blender/password/reset/{$this->findTokenForEmail('user@spatie.be')}")
            ->see(fragment('auth.titleChangePassword'))
            ->assertNotLoggedInOnBack()
            ->type('user@spatie.be', 'email') // Required in the tests
            ->type('newpassword', 'password')
            ->type('newpassword', 'password_confirmation')
            ->press(fragment('auth.passwordMail.oldUser.resetButton'))
            ->assertLoggedInOnBackAs($user);
    }

    protected function requestResetLink() : BackPasswordsTest
    {
        return $this
            ->visit('/blender/login')
            ->click(fragment('back.auth.forgotPassword'))
            ->seePageIs('/blender/password/email')
            ->type('user@spatie.be', 'email')
            ->press(fragment('back.auth.resetPassword.button'));
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
