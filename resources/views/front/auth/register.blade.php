@extends('front._layouts.master')

@section('title', fragment('auth.titleRegister'))

@section('content')
    <div class="grid">
        <a href="{{ URL::action('Front\AuthController@getLogin') }}">{{ fragment('auth.toLogin') }}</a>
        {!! Form::open() !!}
        <div class="form-line">
            {!! Form::label('first_name', fragment('auth.firstName'), ['class'=>'required']) !!}
            <div class="form-element">
                {!! Form::text('first_name') !!}
                {!! HTML::error($errors->first('first_name')) !!}
            </div>
            {!! Form::label('last_name', fragment('auth.lastName'), ['class'=>'required']) !!}
            <div class="form-element">
                {!! Form::text('last_name') !!}
                {!! HTML::error($errors->first('last_name')) !!}
            </div>
        </div>
        <div class="form-line">
            {!! Form::label('address', fragment('auth.address'), ['class'=>'required']) !!}
            <div class="form-element">
                {!! Form::text('address') !!}
                {!! HTML::error($errors->first('address')) !!}
            </div>
            {!! Form::label('postal', fragment('auth.postal'), ['class'=>'required']) !!}
            <div class="form-element">
                {!! Form::text('postal') !!}
                {!! HTML::error($errors->first('postal')) !!}
            </div>

            {!! Form::label('city', fragment('auth.city'), ['class'=>'required']) !!}
            <div class="form-element">
                {!! Form::text('city') !!}
                {!! HTML::error($errors->first('city')) !!}
            </div>
        </div>
        {!! Form::label('country', fragment('auth.country'), ['class'=>'required']) !!}
        <div class="form-element">
            {!! Form::text('country') !!}
            {!! HTML::error($errors->first('country')) !!}
        </div>
        <div class="form-line">
            {!! Form::label('telephone', fragment('auth.telephone'), ['class'=>'required']) !!}
            <div class="form-element">
                {!! Form::text('telephone') !!}
                {!! HTML::error($errors->first('telephone')) !!}
            </div>
        </div>
        <div class="form-line">
            {!! Form::label('email', fragment('auth.email'), ['class'=>'required']) !!}
            <div class="form-element">
                {!! Form::email('email') !!}
                {!! HTML::error($errors->first('email')) !!}
            </div>
        </div>
        <div class="form-line">
            {!! Form::label('password', fragment('auth.password')) !!}
            <div class="form-element">
                {!! Form::password('password', [ ]) !!}
                {!! HTML::error($errors->first('password')) !!}
            </div>
        </div>
        <div class="form-line">
            {!! Form::label('password_confirmation', fragment('auth.passwordConfirm')) !!}
            <div class="form-element">
                {!! Form::password('password_confirmation', [ ]) !!}
                {!! HTML::error($errors->first('password_confirmation')) !!}
            </div>
        </div>
        <div class="form_group -buttons">
            {!! Form::button(fragment('auth.register'), ['type'=>'submit', 'class'=>'button -default']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
