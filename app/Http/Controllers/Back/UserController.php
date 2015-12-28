<?php

namespace App\Http\Controllers\Back;

use Activity;
use App\Events\UserWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\UserRequest;
use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\Updaters\UserUpdater;
use App\Models\User;
use App\Repositories\UserRepository;
use Event;
use URL;

class UserController extends Controller
{
    public function redirectToDefaultIndex()
    {
        return redirect()->action('Back\UserController@index', ['role' => UserRole::ADMIN]);
    }

    public function index($role)
    {
        $users = app(UserRepository::class)->getAllWithRole(new UserRole($role));

        return view('back.user.index')->with(compact('users', 'role'));
    }

    public function create($role)
    {
        $user = new User();
        $user->role = $role;

        return view("back.user.{$role}.create")->with(compact('user', 'role'));
    }

    public function store(UserRequest $request, $role)
    {
        $user = new User();

        $user = UserUpdater::create($user, $request)->update();

        $user->role = $role;
        $user->status = UserStatus::ACTIVE;

        if ($user->password === '') {
            $user->password = str_random(16);
        }

        app(UserRepository::class)->save($user);

        $eventDescription = trans('back-users.passwordMailSent');

        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        Event::fire(new UserWasCreated($user));

        return redirect(action('Back\UserController@index', ['role' => $user->role]));
    }

    public function edit($id)
    {
        $user = app(UserRepository::class)->findById($id);

        return view("back.user.{$user->role}.edit")->with(compact('user'));
    }

    public function update($id, UserRequest $request)
    {
        $user = app(UserRepository::class)->findByIdOrAbort($id);

        $user = UserUpdater::create($user, $request)->update();

        app(UserRepository::class)->save($user);

        $eventDescription = trans('back.events.updated', ['model' => 'Gebruiker', 'name' => $user->email]);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect(URL::action('Back\UserController@index', ['role' => $user->role]));
    }

    public function activate($id)
    {
        $user = app(UserRepository::class)->findByIdOrAbort($id);

        $user->activate();

        $eventDescription = trans('back.events.activated', ['model' => 'Gebruiker', 'name' => $user->email]);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return back();
    }

    public function destroy($id)
    {
        $user = app(UserRepository::class)->findById($id);

        $eventDescription = trans('back.events.deleted', ['model' => 'Gebruiker', 'name' => $user->email]);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        app(UserRepository::class)->delete($user);

        return redirect(URL::action('Back\UserController@index', ['role' => $user->role]));
    }
}
