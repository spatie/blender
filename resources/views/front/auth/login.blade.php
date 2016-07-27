@extends('front._layouts.master')

@section('title', fragment('auth.titleLogin'))

@section('content')
    <div class="grid">
        @include('back._layouts._partials.flashMessage', ['extraClass' => '-fixed'])
        {!! Form::open() !!}
        <div class="form-line">
            {!! Form::label('email', fragment('auth.email'), ['class' => '-invers']) !!}
            <div class="form-element">
                {!! Form::email('email', old('email'), ['autofocus' => true ]) !!}
                {!! Html::error($errors->first('email')) !!}
            </div>
            {!! Form::label('password', fragment('auth.password'), ['class' => '-invers']) !!}
            <div class="form-element">
                {!! Form::password('password', [ ]) !!}
                {!! Html::error($errors->first('password')) !!}
                <div class="form_group_help">
                    <a href="{{ action('Front\PasswordController@getEmail') }}">{{ fragment('auth.forgotPassword') }}</a>
                </div>
            </div>
        </div>
        <div class="form_group -buttons">
            {!! Form::button(fragment('auth.login'), ['type'=>'submit', 'class'=>'button -default']) !!}
            <div class="form_group_help">
                <a href="{{ register_url() }}">{{ fragment('auth.noAccount') }}</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
