<?php

namespace Tests\Browser\Back;

use Hash;
use Laravel\Dusk\Browser;
use Tests\Browser\TestCase;
use App\Services\Auth\Back\User;

class PasswordResetTest extends TestCase
{
    /** @test */
    public function it_can_link_from_the_login_form_to_the_password_reset_form()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/blender')
                ->assertSee('Wachtwoord vergeten?')
                ->clickLink('Wachtwoord vergeten?')
                ->assertPathIs('/blender/password/reset');
        });
    }

    /** @test */
    public function it_can_reset_passwords()
    {
        $newPassword = 'newpassword';

        $user = User::create([
            'email' => 'test@example.com',
            'first_name' => 'Test',
            'last_name' => 'Test',
            'status' => 'active'
        ]);

        $this->browse(function (Browser $browser) use ($user, $newPassword) {
            $browser
                ->visit('/blender/password/reset')
                ->type('email', $user->email)
                ->press('Link verzenden')
                ->assertSee(__('passwords.sent'))
                ->assertSee('Preview Sent Email')
                ->clickLink('Preview Sent Email')
                ->assertSee('Stel je wachtwoord in');

            $passwordResetUrl = $browser->attribute('a.button.button--green', 'href');

            $browser
                ->visit($passwordResetUrl)
                ->assertSee('WACHTWOORD WIJZIGEN')
                ->type('password', $newPassword)
                ->type('password_confirmation', $newPassword)
                ->press('Wachtwoord instellen')
                ->assertPathIs('/blender')
                ->assertSee(__('passwords.reset'));
        });

        $user = User::where('email', $user->email)->first()->makeVisible('password');

        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}
