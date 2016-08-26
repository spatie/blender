@extends('mails._layouts.master')

@section('content')

    Uw account {{ $user->email }} werd goedgekeurd.

    U kunt <a href="{{ action('Front\AuthController@getLogin') }}">hier</a> inloggen.

@endsection
