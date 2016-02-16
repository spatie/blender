<?php

namespace App\Test\Integration\Concerns;

use App\Services\Auth\Back\User as BackUser;
use App\Services\Auth\Front\User as FrontUser;
use App\Services\Auth\User;

trait UsesAuthentication
{
    /**
     * @param \App\Services\Auth\User $user
     * @param string $section
     *
     * @return static
     */
    protected function assertLoggedInAs(User $user, string $section)
    {
        $guard = $this->app['auth']->guard($section);

        $this->assertTrue($guard->check(),
            "Expected {$section} user {$user->id} to be logged in, not no one is.");

        $this->assertEquals($guard->id(), $user->id,
            "Expected {$section} user {$user->id} to be logged in, not {$guard->id()} is.");

        return $this;
    }

    /**
     * @param \App\Services\Auth\Front\User $user
     *
     * @return static
     */
    protected function assertLoggedInOnFrontAs(FrontUser $user)
    {
        return $this->assertLoggedInAs($user, 'front');
    }

    /**
     * @param \App\Services\Auth\Back\User $user
     *
     * @return static
     */
    protected function assertLoggedInOnBackAs(BackUser $user)
    {
        return $this->assertLoggedInAs($user, 'back');
    }

    /**
     * @param string $section
     *
     * @return static
     */
    protected function assertNotLoggedIn(string $section)
    {
        $this->assertFalse($this->app['auth']->guard($section)->check());

        return $this;
    }

    /** @return static */
    protected function assertNotLoggedInOnFront()
    {
        $this->assertNotLoggedIn('front');

        return $this;
    }

    /** @return static */
    protected function assertNotLoggedInOnBack()
    {
        $this->assertNotLoggedIn('back');

        return $this;
    }

    /**
     * @param \App\Services\Auth\Front\User $user
     *
     * @return static
     */
    protected function actingAsOnFront(FrontUser $user)
    {
        return $this->actingAs($user, 'front');
    }

    /**
     * @param \App\Services\Auth\Back\User $user
     *
     * @return static
     */
    protected function actingAsOnBack(BackUser $user)
    {
        return $this->actingAs($user, 'back');
    }

    protected function createFrontUser($attributes = []) : FrontUser
    {
        return factory(FrontUser::class)->create(array_merge([
            'email' => 'user@spatie.be',
            'password' => 'password',
        ], $attributes));
    }

    protected function createBackUser($attributes = []) : BackUser
    {
        return factory(BackUser::class)->create(array_merge([
            'email' => 'user@spatie.be',
            'password' => 'password',
        ], $attributes));
    }
}
