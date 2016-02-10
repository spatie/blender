@extends('back.layout.master')

@section('pageTitle', fragment('auth.titleLogin'))

@section('content')

<section class="+auth">

    @include('back.layout._partials.flashMessage', ['extraClass' => '-fixed'])

    <div class="+auth_card">
        <h1 class="+auth_title">
            <img class="+auth_logo" src="/images/svg/blender.svg">
            {{ fragment('site.name') }}
        </h1>
        {!! Form::open(['class'=>'-stacked +auth_form']) !!}

            <div class="form_group">
                {!! Form::label('email', fragment('auth.email'), ['class' => '-invers']) !!}
                {!! Form::email('email', old('email'), ['autofocus' => true ]) !!}
                {!! HTML::error($errors->first('email')) !!}
            </div>

            <div class="form_group">
                {!! Form::label('password', fragment('auth.password'), ['class' => '-invers']) !!}
                {!! Form::password('password', [ ]) !!}
                {!! HTML::error($errors->first('password')) !!}
                <div class="form_group_help">
                    <a href="{{ action('Front\AuthController@getEmail') }}">{{ fragment('auth.forgotPassword') }}</a>
                </div>
            </div>

            <div class="form_group -buttons">
                {!! Form::button(fragment('auth.logIn'), ['type'=>'submit', 'class'=>'button -default']) !!}
                <div class="form_group_help">
                    <a href="{{ register_url() }}">{{ fragment('auth.noAccount') }}</a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>
</section>

<div class="+auth_credit">
    picture: Folkert Gorter
</div>
@endsection
