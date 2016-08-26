@extends('back._layouts.master')

@section('pageTitle', fragment('back.auth.titleChangePassword'))

@section('content')
    <section class="+auth">
        {{-- @include('auth._partials.lang') --}}
        <div class="+auth_card">
            <h1 class="+auth_title -small">
                {!! Html::avatar($user, '-large +auth_gravatar') !!}<br>
                {{ fragment('back.auth.resetPassword.title') }}
            </h1>

            {!! Form::open(['action' => 'Back\Auth\ResetPasswordController@reset', 'class'=>'-stacked +auth_form']) !!}
            {!! Form::hidden('token', $token) !!}
            {!! Form::hidden('email', $user->email) !!}
            <p class="alert -info">
                {{ fragment('back.auth.resetInstructions') }}
            </p>

            <div class="form_group">
                {!! Form::label('password', fragment('back.auth.password') ) !!}
                {!! Form::password('password', null, ['autofocus' ]) !!}
            </div>

            <div class="form_group">
                {!! Form::label('password_confirmation', fragment('back.auth.passwordConfirm')) !!}
                {!! Form::password('password_confirmation', [null]) !!}
                {!! Html::error($errors->first('password')) !!}
            </div>

            <div class="form_group -buttons">
                {!! Form::button(trans('auth.passwordMail.' . ($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser') . '.resetButton'), ['type'=>'submit', 'class'=>'button -default']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </section>

@stop
