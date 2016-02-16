@extends('emails.layout.master')

@section('content')

    <?php $user = App\Services\Auth\Front\User::find($userId); ?>

    Uw account {{ $user->email }} werd goedgekeurd.

    U kunt <a href="{{ action('Front\AuthController@getLogin') }}">hier</a> inloggen.

@endsection
