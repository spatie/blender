@extends('back.layout.master')

@section('pageTitle', $user->present()->role . ' ' . $user->email)

@section('breadcrumbs', Breadcrumbs::render('editUserBack', $user))

@section('content')
    <section>
        <div class="grid">
            <h1>Administrator {{ $user->email }}</h1>

            <div>
                {!! HTML::avatar($user) !!} <span class="help -small">{{ trans('back-users.gravatarInfo') }} <a href="https://gravatar.com">gravatar.com</a></span>
            </div>
            {!! Form::model($user, ['method'=>'PATCH', 'action' => ['Back\UserController@update', $user->id] , 'class' =>'-stacked']) !!}
            @include("back.user.{$user->role}._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection
