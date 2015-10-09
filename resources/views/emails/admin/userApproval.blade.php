@extends('emails.layout.master')

@section('content')

    <?php $user = App\Models\User::find($userId); ?>

    <h1>Nieuwe gebruiker</h1>

    <span>
        Een nieuwe gebruiker met emailadres {{ $user->email }} heeft zich aangemeld.

        U kan deze gebruiker goedkeuren <a href="{{URL::action('Back\UserController@edit', [$user->id]) }} ">in de backsite</a>.
    </span>

@endsection
