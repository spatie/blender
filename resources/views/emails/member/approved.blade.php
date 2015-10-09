@extends('emails.layout.master')

@section('content')

    <?php $user = App\Models\User::find($userId); ?>

    Uw account {{ $user->email }} werd goedgekeurd.

    U kunt <a href="{{ URL::route('login') }}">hier</a> inloggen.

@endsection
