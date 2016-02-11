<?php

namespace App\Http\Controllers\Back;

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\Events\UserWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\BackUserRequest;
use App\Services\Auth\Back\User;
use App\Services\Auth\Back\UserUpdater;
use App\Repositories\BackUserRepository;

class BackUserController extends Controller
{
    /** @var \App\Repositories\BackUserRepository */
    protected $backUserRepository;

    public function __construct(BackUserRepository $backUserRepository)
    {
        $this->backUserRepository = $backUserRepository;
    }

    public function index()
    {
        $users = $this->backUserRepository->getAll();

        return view('back.backUsers.index')->with(compact('users'));
    }

    public function create()
    {
        $user = new User();

        return view("back.backUsers.create")->with(compact('user', 'role'));
    }

    public function store(BackUserRequest $request)
    {
        $user = new User();

        UserUpdater::create($user, $request)->update();

        $user->role = UserRole::ADMIN();
        $user->status = UserStatus::ACTIVE();

        $this->backUserRepository->save($user);

        $eventDescription = trans('back-users.passwordMailSent');

        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        event(new UserWasCreated($user));

        return redirect(action('Back\BackUserController@index', ['role' => $user->role]));
    }

    public function edit($id)
    {
        $user = $this->backUserRepository->find($id);

        return view('back.backUsers.edit')->with(compact('user'));
    }

    public function update($id, BackUserRequest $request)
    {
        $user = $this->backUserRepository->findOrAbort($id);

        UserUpdater::create($user, $request)->update();

        $this->backUserRepository->save($user);

        $eventDescription = trans('back.events.updated', ['model' => 'Gebruiker', 'name' => $user->email]);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\BackUserController@index');
    }

    public function activate($id)
    {
        $user = $this->backUserRepository->findOrAbort($id);

        $user->activate();

        $eventDescription = trans('back.events.activated', ['model' => 'Gebruiker', 'name' => $user->email]);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return back();
    }

    public function destroy($id)
    {
        $user = $this->backUserRepository->find($id);

        $eventDescription = trans('back.events.deleted', ['model' => 'Gebruiker', 'name' => $user->email]);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        $this->backUserRepository->delete($user);

        return redirect()->action('Back\BackUserController@index');
    }
}
