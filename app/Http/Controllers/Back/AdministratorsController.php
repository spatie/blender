<?php

namespace App\Http\Controllers\Back;

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\Events\UserCreated;
use App\Http\Requests\Back\BackUserRequest;
use App\Services\Auth\Back\User;
use App\Repositories\BackUserRepository;

class AdministratorsController
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

        return view('back.administrators.index')->with(compact('users'));
    }

    public function create()
    {
        return view('back.administrators.create', ['user' => new User()]);
    }

    public function store(BackUserRequest $request)
    {
        $user = new User();

        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->locale = $request->get('locale', 'nl');

        if ($request->has('password')) {
            $user->password = $request->get('password');
        }

        $user->role = UserRole::ADMIN();
        $user->status = UserStatus::ACTIVE();

        $this->backUserRepository->save($user);

        $eventDescription = $this->getEventDescriptionFor('created', $user);
        activity()->on($user)->log($eventDescription);
        flash()->success(strip_tags($eventDescription).'. '.fragment('back.administrators.passwordMailSent'));

        event(new UserCreated($user));

        return redirect(action('Back\AdministratorsController@index', ['role' => $user->role]));
    }

    public function edit($id)
    {
        $user = $this->backUserRepository->find($id);

        if (! $user) {
            abort(404);
        }

        return view('back.administrators.edit')->with(compact('user'));
    }

    public function update($id, BackUserRequest $request)
    {
        abort_unless($user = $this->backUserRepository->find($id), 500);

        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->locale = $request->get('locale', 'nl');

        if ($request->has('password')) {
            $user->password = $request->get('password');
        }

        $this->backUserRepository->save($user);

        $eventDescription = $this->getEventDescriptionFor('updated', $user);
        activity()->log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\AdministratorsController@index');
    }

    public function activate($id)
    {
        abort_unlees($user = $this->backUserRepository->find($id), 500);

        $user->activate();

        $eventDescription = $this->getEventDescriptionFor('activated', $user);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return back();
    }

    public function destroy($id)
    {
        $user = $this->backUserRepository->find($id);

        $eventDescription = $this->getEventDescriptionFor('deleted', $user);

        $this->backUserRepository->delete($user);

        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\AdministratorsController@index');
    }

    protected function getEventDescriptionFor(string $event, User $user): string
    {
        $name = sprintf(
            '<a href="%s">%s</a>',
            action('Back\AdministratorsController@edit', [$user->id]),
            $user->email
        );

        if ($event === 'deleted') {
            $name = $user->email;
        }

        return trans("back.events.$event", ['model' => fragment('back.administrators.administrator'), 'name' => $name]);
    }
}
