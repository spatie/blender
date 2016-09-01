@extends('front._layouts.main')

@section('title', fragment('auth.titleLogin'))

@section('mainContent')

        {!! Form::open() !!}

        <p>
            {!! Form::label('email', fragment('auth.email')) !!}
            {!! Form::email('email', old('email'), ['autofocus' => true ]) !!}
            {!! Html::error($errors->first('email')) !!}
        </p>
        <p>
            {!! Form::label('password', fragment('auth.password')) !!}
                {!! Form::password('password', [ ]) !!}
                {!! Html::error($errors->first('password')) !!}
        </p>
        <p>
            <a href="{{ action('Front\Auth\ForgotPasswordController@showLinkRequestForm') }}">{{ fragment('auth.forgotPassword') }}</a>
        </p>
        <p>
            {!! Form::button(fragment('auth.login'), ['type'=>'submit']) !!}
        </p>

        {!! Form::close() !!}

        <p>
            <a href="{{ register_url() }}">{{ fragment('auth.noAccount') }}</a>
        </p>
@endsection
