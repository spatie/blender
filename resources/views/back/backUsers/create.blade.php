
@extends('back.layout.master')

@section('pageTitle', 'Nieuwe gebruiker')

@section('content')
    <section>
        <div class="grid">
            <h1>{{ trans("back-users.role.{$role}.new") }}</h1>

            {!! Form::open(['url'=>action('Back\UserController@store',['role'=>$user->role]), 'class' =>'-stacked' ]) !!}
                @include("back.user.{$user->role}._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection


@section('breadcrumbs', Breadcrumbs::render('newUserBack', $user))

