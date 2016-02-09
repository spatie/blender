<?php

namespace App\Test\Integration\Auth\Registration;

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\User;
use Spatie\Integration\FrontTestCase;

class MemberTest extends FrontTestCase
{
    /**
     * @test
     */
    public function a_member_can_be_registered()
    {
        $testUser = factory(User::class)->make();

        $this->visit(action('Auth\RegistrationController@showRegistrationForm', UserRole::MEMBER))

            ->type($testUser->first_name, 'first_name')
            ->type($testUser->last_name, 'last_name')
            ->type($testUser->email, 'email')
            ->type('123456789', 'password')
            ->type('123456789', 'password_confirmation')

            ->press(trans('auth.register.member.submit'))
        ;

        $this->seeInDatabase('users', [
            'first_name' => $testUser->first_name,
            'last_name' => $testUser->last_name,
            'email' => $testUser->email,
            'status' => UserStatus::WAITING_FOR_APPROVAL,
            'role' => UserRole::MEMBER,
            'locale' => 'nl',
        ]);
    }
}
