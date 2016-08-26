@extends('emails._layouts.master')

@section('content')

    <?php $user = App\Services\Auth\Front\User::find($userId); ?>

    <h1>Nieuwe gebruiker</h1>

    <span>
        Een nieuwe gebruiker met emailadres {{ $user->email }} heeft zich aangemeld.

        U kan deze gebruiker goedkeuren <a href="{{URL::action('Back\FrontUserController@edit', [$user->id]) }} ">in de backsite</a>.
    </span>

@endsection
