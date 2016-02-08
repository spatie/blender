@extends('front.layout.master')

@section('pageTitle', Lang::get('auth.titleLogin'))

@section('content')

    <a href="{{ URL::action('Auth\AuthController@getLogin') }}">Naar login</a>

    {!! Form::open() !!}

    <div class="form-line">
        {!! Form::label('first_name', 'Voornaam', ['class'=>'required']) !!}
        <div class="form-element">
            {!! Form::text('first_name') !!}
            {!! HTML::error($errors->first('first_name')) !!}
        </div>

        {!! Form::label('last_name', 'Naam', ['class'=>'required']) !!}
        <div class="form-element">
            {!! Form::text('last_name') !!}
            {!! HTML::error($errors->first('last_name')) !!}
        </div>
    </div>

    <div class="form-line">
        {!! Form::label('address', 'Adres', ['class'=>'required']) !!}
        <div class="form-element">
            {!! Form::text('address') !!}
            {!! HTML::error($errors->first('address')) !!}
        </div>

        {!! Form::label('postal', 'Postcode', ['class'=>'required']) !!}
        <div class="form-element">
            {!! Form::text('postal') !!}
            {!! HTML::error($errors->first('postal')) !!}
        </div>

        {!! Form::label('city', 'Plaatsnaam', ['class'=>'required']) !!}
        <div class="form-element">
            {!! Form::text('city') !!}
            {!! HTML::error($errors->first('city')) !!}
        </div>
    </div>

    {!! Form::label('country', 'Land', ['class'=>'required']) !!}
    <div class="form-element">
        {!! Form::text('country') !!}
        {!! HTML::error($errors->first('country')) !!}
    </div>

    <div class="form-line">
        {!! Form::label('telephone', 'Telefoon', ['class'=>'required']) !!}
        <div class="form-element">
            {!! Form::text('telephone') !!}
            {!! HTML::error($errors->first('telephone')) !!}
        </div>
    </div>

    <div class="form-line">
        {!! Form::label('email', 'E-mail', ['class'=>'required']) !!}
        <div class="form-element">
            {!! Form::email('email') !!}
            {!! HTML::error($errors->first('email')) !!}
        </div>
    </div>

    <div class="form-line">
        {!! Form::label('password', trans('back-users.password')) !!}
        <div class="form-element">
            {!! Form::password('password', [ ]) !!}
            {!! HTML::error($errors->first('password')) !!}
        </div>
    </div>

    <div class="form-line">
        {!! Form::label('password_confirmation', trans('back-users.passwordConfirmation')) !!}
        <div class="form-element">
            {!! Form::password('password_confirmation', [ ]) !!}
            {!! HTML::error($errors->first('password_confirmation')) !!}
        </div>
    </div>

    <div class="form-line">
        {!! Form::label('Ik wil me abonneren op de nieuwsbrief') !!}
        {!! Form::checkbox('subscribe_to_newsletter') !!}
    </div>

    <div class="form_group -buttons">
        {!! Form::button(trans('auth.register.member.submit'), ['type'=>'submit', 'class'=>'button -default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
