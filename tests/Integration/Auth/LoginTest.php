<?php

namespace App\Test\Integration\Auth;

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\User;
use Spatie\Integration\TestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends TestCase
{
    /**
     * @test
     */
    public function it_will_redirect_protected_routes()
    {
        $this->visit('/blender')
            ->seePageIs('/nl/auth/login');
    }

    /**
     * @test
     * @dataProvider roleProvider
     *
     * @param $role
     */
    public function non_active_users_cannot_login($role)
    {
        $password = 'test12345';

        $user = factory(User::class)->create([
            'role' => $role,
            'status' => UserStatus::WAITING_FOR_APPROVAL,
            'password' => $password,
        ]);

        $this->visit('/nl/auth/login')
            ->type($user->email, 'email')
            ->type($password, 'password')
            ->press(trans('auth.logIn'));

        $this
            ->seePageIs('/nl/auth/login')
            ->see(trans('auth.notActivatedError'));
    }

    /**
     * @test
     * @dataProvider roleProvider
     *
     * @param $role
     */
    public function only_an_admin_can_view_the_backsite($role)
    {
        $user = factory(User::class)->create(['role' => $role, 'status' => UserStatus::ACTIVE]);

        $this->actingAs($user);

        $this->call('GET', 'blender');

        $role == UserRole::ADMIN
            ?  $this->seePageIs('blender')
            : $this->seeStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function activated_members_get_redirected_to_the_home_page()
    {
        $password = 'test12345';

        $user = factory(User::class)->create([
            'role' => UserRole::MEMBER,
            'status' => UserStatus::ACTIVE,
            'password' => $password,
        ]);

        $this->visit('/nl/auth/login')
            ->type($user->email, 'email')
            ->type($password, 'password')
            ->press(trans('auth.logIn'));

        $this->seePageIs('/nl');

        $this->isLoggedIn($user);
    }

    public function isLoggedIn($user)
    {
        $errorMessage =  "Failed to assert that user {$user->id} is logged in.";

        $this->assertTrue(auth()->check(), $errorMessage);

        $this->assertEquals(auth()->user()->id, User::where('email', $user->email)->first()->id,
            $errorMessage);

        return true;
    }

    public function roleProvider()
    {
        return array_map(function ($role) {
            return [$role];
        }, UserRole::toArray());
    }
}
