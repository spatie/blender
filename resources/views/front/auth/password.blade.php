@extends('front.layout.master')

@section('pageTitle', fragment('auth.titleResetPassword'))

@section('content')
<section class="+auth">

    @include('back.layout._partials.flashMessage', ['extraClass' => '-fixed'])

    <div class="+auth_card">
        <h1 class="+auth_title -small">{{ fragment('auth.titleResetPassword') }}</h1>
        {!! Form::open(['class'=>'-stacked +auth_form']) !!}
        @if(session('status'))
        <p class="alert -info">
            {{ session('status') }}
        </p>
        @else
        <p class="alert -invers">
            {{ fragment('auth.resetPasswordIntro') }}
        </p>
        @endif
        <div class="form_group">
            {!! Form::label('email', fragment('auth.email'), ['class' => '-invers']) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
            {!! HTML::error($errors->first('email')) !!}
        </div>

        <div class="form_group -buttons">
            {!! Form::button( fragment('auth.resetPasswordButton'), ['type'=>'submit', 'class'=>'button -default']) !!}
        </div>
        <div class="form_group_help">
            <a href="{{ login_url() }}">{{ fragment('auth.toLogin') }}</a>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection
