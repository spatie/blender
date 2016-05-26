<?php

namespace App\Http\Controllers\Back;

use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\Events\UserWasCreatedThroughBack;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\FrontUserRequest;
use App\Services\Auth\Front\User;
use App\Services\Auth\Front\UserUpdater;
use App\Repositories\FrontUserRepository;

class FrontUserController extends Controller
{
    /** @var \App\Repositories\FrontUserRepository */
    protected $frontUserRepository;

    public function __construct(FrontUserRepository $frontUserRepository)
    {
        $this->frontUserRepository = $frontUserRepository;
    }

    public function index()
    {
        $users = $this->frontUserRepository->getAll();

        return view('back.frontUsers.index')->with(compact('users'));
    }

    public function create()
    {
        return view('back.frontUsers.create', ['user' => new User()]);
    }

    public function store(FrontUserRequest $request)
    {
        $user = new User();

        UserUpdater::update($user, $request);

        $user->role = UserRole::MEMBER();
        $user->status = UserStatus::ACTIVE();

        $this->frontUserRepository->save($user);

        $eventDescription = $this->getEventDescriptionFor('created', $user);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription).'. '.fragment('back.frontUsers.passwordMailSent'));

        event(new UserWasCreatedThroughBack($user));

        return redirect()->action('Back\FrontUserController@index');
    }

    public function edit($id)
    {
        $user = $this->frontUserRepository->find($id);

        if (!$user) {
            abort(404);
        }

        return view('back.frontUsers.edit')->with(compact('user'));
    }

    public function update($id, FrontUserRequest $request)
    {
        $user = $this->frontUserRepository->findOrAbort($id);

        UserUpdater::update($user, $request);

        $this->frontUserRepository->save($user);

        $eventDescription = $this->getEventDescriptionFor('updated', $user);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\FrontUserController@index');
    }

    public function destroy($id)
    {
        $user = $this->frontUserRepository->find($id);

        $eventDescription = $this->getEventDescriptionFor('deleted', $user);

        $this->frontUserRepository->delete($user);

        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\FrontUserController@index');
    }

    protected function getEventDescriptionFor(string $event, User $user):string
    {
        $name = sprintf(
            '<a href="%s">%s</a>',
            action('Back\FrontUserController@edit', [$user->id]),
            $user->email
        );

        if ($event === 'deleted') {
            $name = $user->email;
        }

        return trans("back.events.$event", ['model' => fragment('back.frontUsers.member'), 'name' => $name]);
    }
}
