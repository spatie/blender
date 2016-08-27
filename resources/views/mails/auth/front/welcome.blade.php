@extends('mails._layouts.master')

@section('content')

    Welkom, {{ $user->first_name }}

    U kunt <a href="{{ action('Front\Auth\LoginController@login') }}">hier</a> inloggen.

@endsection
