@extends('back._layouts.master')

@section('pageTitle', fragment('back.auth.titleLogin'))

@section('content')

<section class="+auth">

    @include('back._layouts._partials.flashMessage', ['extraClass' => '-fixed'])

    {{-- @include('auth._partials.lang') --}}
    <div class="+auth_card">
        {!! Form::open(['class'=>'-stacked +auth_form']) !!}
            <h1 class="+auth_title">
                <img class="+auth_logo" src="/images/svg/blender.svg">
                Blender
            </h1>

            <div class="form_group">
                {!! Form::label('email', fragment('back.auth.email') ) !!}
                {!! Form::email('email', Input::old('email'), ['autofocus' => true ]) !!}
                {!! HTML::error($errors->first('email')) !!}
            </div>

            <div class="form_group">
                {!! Form::label('password', fragment('back.auth.password')) !!}
                {!! Form::password('password', [ ]) !!}
                {!! HTML::error($errors->first('password')) !!}
                <div class="form_group_help">
                    <a href="{{ action('Back\PasswordController@getEmail') }}">{{ fragment('back.auth.forgotPassword') }}</a>
                </div>
            </div>

            <div class="form_group -buttons">
            {!! Form::button(fragment('back.auth.login'), ['type'=>'submit', 'class'=>'button -default']) !!}
            </div>

        {!! Form::close() !!}
    </div>
</section>

{{--
<div class="+auth_credit">
    picture: Folkert Gorter
</div>
--}}
@endsection
