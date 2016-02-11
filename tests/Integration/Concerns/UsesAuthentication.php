<?php

namespace App\Test\Integration\Concerns;

use App\Services\Auth\Back\User as BackUser;
use App\Services\Auth\Front\User as FrontUser;
use App\Services\Auth\User;

trait UsesAuthentication
{
    /** @return static */
    protected function assertLoggedInAs(User $user, string $section)
    {
        $this->assertTrue($this->app['auth']->guard($section)->check());
        $this->assertEquals($this->app['auth']->guard($section)->id(), $user->id);

        return $this;
    }

    /** @return static */
    protected function assertLoggedInOnFrontAs(FrontUser $user)
    {
        return $this->assertLoggedInAs($user, 'front');
    }

    /** @return static */
    protected function assertLoggedInOnBackAs(BackUser $user)
    {
        return $this->assertLoggedInAs($user, 'back');
    }

    /** @return static */
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

    /** @return static */
    protected function actingAsOnFront(FrontUser $user)
    {
        return $this->actingAs($user, 'front');
    }

    /** @return static */
    protected function actingAsOnBack(BackUser $user)
    {
        return $this->actingAs($user, 'back');
    }

    protected function createFrontUser($attributes = []) : FrontUser
    {
        return factory(FrontUser::class)->create(array_merge([
            'email' => 'user@spatie.be',
            'password' => 'secret',
        ], $attributes));
    }

    protected function createBackUser($attributes = []) : BackUser
    {
        return factory(BackUser::class)->create(array_merge([
            'email' => 'user@spatie.be',
            'password' => 'secret',
        ], $attributes));
    }
}
