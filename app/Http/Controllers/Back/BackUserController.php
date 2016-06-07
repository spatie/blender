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
        return view('back.backUsers.create', ['user' => new User()]);
    }

    public function store(BackUserRequest $request)
    {
        $user = new User();

        UserUpdater::update($user, $request);

        $user->role = UserRole::ADMIN();
        $user->status = UserStatus::ACTIVE();

        $this->backUserRepository->save($user);

        $eventDescription = $this->getEventDescriptionFor('created', $user);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription).'. '.fragment('back.backUsers.passwordMailSent'));

        event(new UserWasCreated($user));

        return redirect(action('Back\BackUserController@index', ['role' => $user->role]));
    }

    public function edit($id)
    {
        $user = $this->backUserRepository->find($id);

        if (!$user) {
            abort(404);
        }

        return view('back.backUsers.edit')->with(compact('user'));
    }

    public function update($id, BackUserRequest $request)
    {
        $user = $this->backUserRepository->findOrAbort($id);

        UserUpdater::update($user, $request);

        $this->backUserRepository->save($user);

        $eventDescription = $this->getEventDescriptionFor('updated', $user);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\BackUserController@index');
    }

    public function activate($id)
    {
        $user = $this->backUserRepository->findOrAbort($id);

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

        return redirect()->action('Back\BackUserController@index');
    }

    protected function getEventDescriptionFor(string $event, User $user): string
    {
        $name = sprintf(
            '<a href="%s">%s</a>',
            action('Back\BackUserController@edit', [$user->id]),
            $user->email
        );

        if ($event === 'deleted') {
            $name = $user->email;
        }

        return trans("back.events.$event", ['model' => fragment('back.backUsers.administrator'), 'name' => $name]);
    }
}
