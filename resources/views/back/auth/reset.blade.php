@extends('back.layout.master')

@section('pageTitle', fragment('back.auth.titleChangePassword'))

@section('content')
    <section class="+auth">
        {{-- @include('auth._partials.lang') --}}
        <div class="+auth_card">
            <h1 class="+auth_title -small">
                {!! HTML::avatar($user, '-large +auth_gravatar') !!}<br>
                {{ fragment('back.auth.titleChangePassword') }}
            </h1>

            {!! Form::open(['class'=>'-stacked +auth_form']) !!}
            {!! Form::hidden('token', $token) !!}
            {!! Form::hidden('email', $user->email) !!}
            <p class="alert -invers">
                {{ fragment('back.auth.resetInstructions') }}
            </p>

            <div class="form_group">
                {!! Form::label('email', fragment('auth.email'), ['class' => '-invers']) !!}
                <input type="email" value="{{ $user->email }}" disabled autocomplete="off">
                {!! Form::hidden('email', $user->email) !!}
            </div>

            <div class="form_group">
                {!! Form::label('password', fragment('back.auth.password'), ['class' => '-invers'] ) !!}
                {!! Form::password('password', null, ['autofocus' ]) !!}
            </div>

            <div class="form_group">
                {!! Form::label('password_confirmation', fragment('back.auth.passwordConfirm'), ['class' => '-invers']) !!}
                {!! Form::password('password_confirmation', [null]) !!}
                {!! HTML::error($errors->first('password')) !!}
            </div>

            <div class="form_group -buttons">
                {!! Form::button(trans('auth.passwordMail.' . ($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser') . '.resetButton'), ['type'=>'submit', 'class'=>'button -default']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </section>

@stop
