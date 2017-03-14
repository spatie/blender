@extends('mail::message')
Uw account {{ $user->email }} werd goedgekeurd.

U kunt [hier]({{ action('Front\AuthController@getLogin') }}) inloggen.
@endsection
