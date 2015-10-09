@extends('back.layout.master')

@section('pageTitle', Lang::get('auth.titleResetPassword'))

@section('content')
<section class="+auth">
    {{-- @include('auth._partials.lang') --}}
    <div class="+auth_card">
        <h1 class="+auth_title -small">{{ Lang::get('auth.titleResetPassword') }}</h1>
        {!! Form::open(['class'=>'-stacked +auth_form']) !!}
        <p class="alert -invers">
            {{ Lang::get('auth.resetPasswordIntro') }}
        </p>
        <div class="form_group">
            {!! Form::label('email', Lang::get('auth.email'), ['class' => '-invers']) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
            {!! HTML::error($errors->first('email')) !!}
        </div>

        <div class="form_group -buttons">
            {!! Form::button( Lang::get('auth.resetPasswordButton'), ['type'=>'submit', 'class'=>'button -default']) !!}
        </div>
        <div class="form_group_help">
            <a href="{{ URL::route('login') }}">{{ Lang::get('auth.toLogin') }}</a>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection
