@extends('back._layouts.main')

@section('title', fragment('auth.titleChangePassword'))

@section('mainTitle')
    <h1 class="+auth_title -small">
        {!! Html::avatar($user, '-large +auth_gravatar') !!}<br>
        {{ fragment('auth.titleChangePassword') }}
    </h1>
@endsection

@section('mainContent')

    {!! Form::open(['action' => 'Front\Auth\ResetPasswordController@reset']) !!}
    {!! Form::hidden('token', $token) !!}
    {!! Form::hidden('email', $user->email) !!}
    <p class="alert">
        {{ fragment('auth.resetInstructions') }}
    </p>
    <p>
        {!! Form::label('password', fragment('auth.password') ) !!}
        {!! Form::password('password', null, ['autofocus' ]) !!}
    </p>
    <p>
        {!! Form::label('password_confirmation', fragment('auth.passwordConfirm')) !!}
        {!! Form::password('password_confirmation', [null]) !!}
        {!! Html::error($errors->first('password')) !!}
    </p>
    <p>
        {!! Form::button(trans('auth.passwordMail.' . ($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser') . '.resetButton'), ['type'=>'submit']) !!}
    </p>

    {!! Form::close() !!}

@stop
