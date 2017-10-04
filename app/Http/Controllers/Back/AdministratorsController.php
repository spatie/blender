<?php

namespace App\Http\Controllers\Back;

use App\Services\Auth\Back\Enums\UserRole;
use App\Services\Auth\Back\Enums\UserStatus;
use App\Services\Auth\Back\Events\UserCreated;
use App\Services\Auth\Back\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdministratorsController
{
    use ValidatesRequests;

    public function index()
    {
        $users = User::all();

        return view('back.administrators.index', compact('users'));
    }

    public function create()
    {
        return view('back.administrators.create', ['user' => new User()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules());

        $user = new User();

        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');

        if ($request->has('password')) {
            $user->password = bryct($request->get('password'));
        }

        $user->role = UserRole::ADMIN;
        $user->status = UserStatus::ACTIVE;

        $user->save();

        $eventDescription = $this->getEventDescriptionFor('created', $user);
        activity()->on($user)->log($eventDescription);
        flash()->success(strip_tags($eventDescription).'. '.__('Er werd een mail verstuurd naar de gebruiker waarmee een wachtwoord kan ingesteld worden'));

        event(new UserCreated($user));

        return redirect(action('Back\AdministratorsController@index', ['role' => $user->role]));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('back.administrators.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, $this->validationRules());

        $user = User::findOrFail($id);

        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');

        if ($request->has('password')) {
            $user->password = $request->get('password');
        }

        $user->save();

        $eventDescription = $this->getEventDescriptionFor('updated', $user);
        activity()->on($user)->log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\AdministratorsController@index');
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);

        $user->activate();

        $eventDescription = $this->getEventDescriptionFor('activated', $user);
        activity($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $eventDescription = $this->getEventDescriptionFor('deleted', $user);

        $user->delete();

        activity()->log($eventDescription);
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

        return "Administrator {$name} was {$event}.";
    }

    protected function validationRules(): array
    {
        return [
            'email' => $this->getEmailValidationRule(),
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'confirmed',
        ];
    }

    protected function getEmailValidationRule(): string
    {
        $uniqueRule = Rule::unique('users_back', 'email');

        if (request()->method() === 'PATCH') {
            $userId = request()->route('administrator');

            $uniqueRule = $uniqueRule->ignore($userId);
        }

        return "required|email|{$uniqueRule}";
    }
}
