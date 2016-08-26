@extends('emails._layouts.master')

@section('content')

    <?php $user = App\Services\Auth\Front\User::find($userId); ?>

    Welkom, {{ $user->first_name }}

    U kunt <a href="{{ action('Front\AuthController@getLogin') }}">hier</a> inloggen.

@endsection
