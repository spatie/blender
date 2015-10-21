<?php

namespace App\Test\Integration\Back;

use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\User;

class UserTest extends BackTestCase
{
    public function setUp()
    {
        parent::setUp();

        foreach (UserRole::values() as $userRole) {
            factory(User::class, 10)->create(['role' => $userRole]);
        }
    }

    /**
     * @test
     */
    public function it_can_activate_a_user_that_is_waiting_for_approval()
    {
        $userWaitingForApproval = factory(User::class)->create(
            ['status' => UserStatus::WAITING_FOR_APPROVAL, 'role' => UserRole::MEMBER]
        );

        $this->visit(action('Back\UserController@edit', ['id' => $userWaitingForApproval->id]))
            ->click("#activate_user_{$userWaitingForApproval->id}")
            ->seeInDatabase('users', ['email' => $userWaitingForApproval->email, 'status' => UserStatus::ACTIVE]);
    }

    /**
     * @dataProvider roleProvider
     * @test
     *
     * @param string $role
     */
    public function it_displays_a_list_of_all_users($role)
    {
        $usersWithRole = User::where('role', $role);
        $usersWithoutRole = User::where('role', '<>', $role);

        $this->visit(action('Back\UserController@index', compact('role')));

        foreach ($usersWithRole as $user) {
            $this->see($user->email);
        }

        foreach ($usersWithoutRole as $user) {
            $this->dontSee($user->email);
        }
    }

    /**
     * @dataProvider roleProvider
     * @test
     *
     * @param string $role
     */
    public function it_can_create_a_user_with_role($role)
    {
        $testUser = factory(User::class)->make();

        $properties = $this->getPropertiesForRole($role);

        $this
            ->visit(action('Back\UserController@index', compact('role')))
            ->click(trans("back-users.role.{$role}.new"));

        foreach ($properties as $property) {
            $this->type($testUser->$property, $property);
        }

        $this->press(trans('back-users.save'))
            ->seePageIs(action('Back\UserController@index', compact('role')))
            ->see($testUser->email);

        $expectedDatabaseFields = [];
        foreach ($properties as $property) {
            $expectedDatabaseFields[$property] = $testUser->$property;
        }
        $expectedDatabaseFields['status'] = UserStatus::ACTIVE;
        $expectedDatabaseFields['locale'] = 'nl';
        $expectedDatabaseFields['role'] = $role;

        $this->seeInDatabase('users', $expectedDatabaseFields);
    }

    /**
     * @dataProvider roleProvider
     * @test
     *
     * @param $role
     */
    public function it_can_edit_a_user_with_a_role($role)
    {
        $user = User::where('role', $role)->first();

        $this
            ->visit(action('Back\UserController@index', compact('role')))
            ->click($user->email)
            ->seePageIs(action('Back\UserController@edit', [$user->id]))
            ->press(trans('back-users.save'))
            ->seePageIs(action('Back\UserController@index', compact('role')));
    }

    /**
     * @dataProvider roleProvider
     * @test
     *
     * @param $role
     */
    public function it_can_delete_a_user_with_a_role($role)
    {
        $user = User::where('role', $role)->first();

        $this
            ->visit(action('Back\UserController@index', compact('role')))
            ->press('delete_user_'.$user->id)
            ->seePageIs(action('Back\UserController@index', compact('role')))
            ->notSeeInDatabase('users', ['email' => $user->email]);
    }

    public function roleProvider()
    {
        return array_map(function ($role) {
            return [$role];
        }, UserRole::toArray());
    }

    /**
     * @param string $role
     *
     * @return array
     */
    protected function getPropertiesForRole($role)
    {
        $properties = [];

        $properties[UserRole::ADMIN] = ['email', 'first_name', 'last_name'];
        $properties[UserRole::MEMBER] = array_merge($properties[UserRole::ADMIN], [
            'address',
            'postal',
            'city',
            'country',
            'telephone',
        ]);

        return $properties[$role];
    }
}
