@extends('front._layouts.main')

@section('title', fragment('auth.titleRegister'))

@section('mainContent')
    <p>
        <a href="{{ URL::action('Front\Auth\LoginController@showLoginForm') }}">{{ fragment('auth.toLogin') }}</a>
    </p>

    {!! Form::open() !!}

    <p>
        {!! Form::label('first_name', fragment('auth.firstName'), ['class'=>'required']) !!}
        {!! Form::text('first_name') !!}
        {!! Html::error($errors->first('first_name')) !!}
    </p>
    <p>
        {!! Form::label('last_name', fragment('auth.lastName'), ['class'=>'required']) !!}
        {!! Form::text('last_name') !!}
        {!! Html::error($errors->first('last_name')) !!}
    </p>
    <p>
        {!! Form::label('address', fragment('auth.address'), ['class'=>'required']) !!}
        {!! Form::text('address') !!}
        {!! Html::error($errors->first('address')) !!}
    </p>
    <p>
        {!! Form::label('postal', fragment('auth.postal'), ['class'=>'required']) !!}
        {!! Form::text('postal') !!}
        {!! Html::error($errors->first('postal')) !!}
    </p>
    <p>
        {!! Form::label('city', fragment('auth.city'), ['class'=>'required']) !!}
        {!! Form::text('city') !!}
        {!! Html::error($errors->first('city')) !!}
    </p>
    <p>
        {!! Form::label('country', fragment('auth.country'), ['class'=>'required']) !!}
        {!! Form::text('country') !!}
        {!! Html::error($errors->first('country')) !!}
    </p>
    <p>
        {!! Form::label('telephone', fragment('auth.telephone'), ['class'=>'required']) !!}
        {!! Form::text('telephone') !!}
        {!! Html::error($errors->first('telephone')) !!}
    </p>
    <p>
        {!! Form::label('email', fragment('auth.email'), ['class'=>'required']) !!}
        {!! Form::email('email') !!}
        {!! Html::error($errors->first('email')) !!}
    </p>
    <p>
        {!! Form::label('password', fragment('auth.password')) !!}
        {!! Form::password('password', [ ]) !!}
        {!! Html::error($errors->first('password')) !!}
    </p>
    <p>
        {!! Form::label('password_confirmation', fragment('auth.passwordConfirm')) !!}
        {!! Form::password('password_confirmation', [ ]) !!}
        {!! Html::error($errors->first('password_confirmation')) !!}
    </p>
    <p>
        {!! Form::button(fragment('auth.register'), ['type'=>'submit']) !!}
    </p>

    {!! Form::close() !!}

@endsection
