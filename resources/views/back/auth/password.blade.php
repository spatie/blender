@extends('back.layout.master')

@section('pageTitle', trans('back-auth.titleResetPassword'))

@section('content')
<section class="+auth">
    {{-- @include('auth._partials.lang') --}}

    @include('back.layout._partials.flashMessage', ['extraClass' => '-fixed'])

    <div class="+auth_card">
        <h1 class="+auth_title -small">{{ trans('back-auth.titleResetPassword') }}</h1>
        {!! Form::open(['class'=>'-stacked +auth_form']) !!}
        <p class="alert -invers">
            {{ trans('back-auth.resetPasswordIntro') }}
        </p>
        <div class="form_group">
            {!! Form::label('email', trans('back-auth.email'), ['class' => '-invers']) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
            {!! HTML::error($errors->first('email')) !!}
        </div>

        <div class="form_group -buttons">
            {!! Form::button( trans('back-auth.resetPasswordButton'), ['type'=>'submit', 'class'=>'button -default']) !!}
        </div>
        <div class="form_group_help">
            <a href="{{ URL::route('login') }}">{{ trans('back-auth.toLogin') }}</a>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection
