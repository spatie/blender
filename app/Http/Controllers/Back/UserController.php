<?php

namespace App\Http\Controllers\Back;

use Activity;
use App\Events\UserWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\UserRequest;
use App\Models\Enums\UserRole;
use App\Models\Enums\UserStatus;
use App\Models\User;
use App\Repositories\UserRepository;
use Event;
use URL;

class UserController extends Controller
{
    /**
     * @var \App\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * @param \App\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirectToDefaultIndex()
    {
        return redirect()->action('Back\UserController@index', ['role' => UserRole::ADMIN]);
    }

    public function index($role)
    {
        $users = $this->userRepository->getAllWithRole($role);

        return view('back.user.index')->with(compact('users', 'role'));
    }

    public function create($role)
    {
        $user = new User();
        $user->role = $role;

        return view("back.user.{$role}.create")->with(compact('user', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @param $role
     *
     * @return Response
     */
    public function store(UserRequest $request, $role)
    {
        $user = new User();

        $user->updateWithRelations($request->all());
        $user->role = $role;
        $user->status = UserStatus::ACTIVE;
        if ($user->password == '') {
            $user->password = str_random(16);
        }

        $this->userRepository->save($user);

        $eventDescription = trans('back-users.passwordMailSent');

        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        Event::fire(new UserWasCreated($user));

        return redirect(action('Back\UserController@index', ['role' => $user->role]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findById($id);

        return view("back.user.{$user->role}.edit")->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int         $id
     * @param UserRequest $request
     *
     * @return Response
     */
    public function update($id, UserRequest $request)
    {
        $user = $this->userRepository->findByIdOrAbort($id);

        $user->updateWithRelations($request->all());

        $this->userRepository->save($user);

        $eventDescription = trans('back.events.updated', ['model' => 'Gebruiker', 'name' => $user->email]);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect(URL::action('Back\UserController@index', ['role' => $user->role]));
    }

    public function activate($id)
    {
        $user = $this->userRepository->findByIdOrAbort($id);

        $user->activate();

        $eventDescription = trans('back.events.activated', ['model' => 'Gebruiker', 'name' => $user->email]);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findById($id);

        $eventDescription = trans('back.events.deleted', ['model' => 'Gebruiker', 'name' => $user->email]);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        $this->userRepository->delete($user);

        return redirect(URL::action('Back\UserController@index', ['role' => $user->role]));
    }
}
