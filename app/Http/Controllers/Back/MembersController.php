<?php

namespace App\Http\Controllers\Back;

use App\Services\Auth\Front\Enums\UserRole;
use App\Services\Auth\Front\Enums\UserStatus;
use App\Services\Auth\Front\Events\UserCreatedThroughBack;
use App\Http\Requests\Back\FrontUserRequest;
use App\Services\Auth\Front\User;
use App\Repositories\FrontUserRepository;

class MembersController
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

        return view('back.members.index')->with(compact('users'));
    }

    public function create()
    {
        return view('back.members.create', ['user' => new User()]);
    }

    public function store(FrontUserRequest $request)
    {
        $user = new User();

        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->locale = $request->get('locale', 'nl');

        $user->role = UserRole::MEMBER();
        $user->status = UserStatus::ACTIVE();

        $this->frontUserRepository->save($user);

        $eventDescription = $this->getEventDescriptionFor('created', $user);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription).'. '.fragment('back.members.passwordMailSent'));

        event(new UserCreatedThroughBack($user));

        return redirect()->action('Back\MembersController@index');
    }

    public function edit($id)
    {
        $user = $this->frontUserRepository->find($id);

        if (! $user) {
            abort(404);
        }

        return view('back.members.edit')->with(compact('user'));
    }

    public function update($id, FrontUserRequest $request)
    {
        abort_unless($user = $this->frontUserRepository->find($id), 500);

        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->locale = $request->get('locale', 'nl');

        $this->frontUserRepository->save($user);

        $eventDescription = $this->getEventDescriptionFor('updated', $user);
        activity()->on($user)->log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\MembersController@index');
    }

    public function destroy($id)
    {
        $user = $this->frontUserRepository->find($id);

        $this->frontUserRepository->delete($user);

        $eventDescription = $this->getEventDescriptionFor('deleted', $user);
        activity()->log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\MembersController@index');
    }

    protected function getEventDescriptionFor(string $event, User $user): string
    {
        $name = sprintf(
            '<a href="%s">%s</a>',
            action('Back\MembersController@edit', [$user->id]),
            $user->email
        );

        if ($event === 'deleted') {
            $name = $user->email;
        }

        return trans("back.events.$event", ['model' => fragment('back.members.member'), 'name' => $name]);
    }
}
