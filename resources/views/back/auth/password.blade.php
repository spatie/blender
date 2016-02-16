@extends('back.layout.master')

@section('pageTitle', fragment('back.auth.titleResetPassword'))

@section('content')
<section class="+auth">
    {{-- @include('auth._partials.lang') --}}

    @include('back.layout._partials.flashMessage', ['extraClass' => '-fixed'])

    <div class="+auth_card">
        <h1 class="+auth_title -small">{{ fragment('back.auth.titleResetPassword') }}</h1>
        {!! Form::open(['class'=>'-stacked +auth_form']) !!}
        @if(session('status'))
            <p class="alert -info">
                {{ session('status') }}
            </p>
        @else
        <p class="alert -invers">
            {{ fragment('back.auth.resetPasswordIntro') }}
        </p>
        @endif
        <div class="form_group">
            {!! Form::label('email', fragment('back.auth.email'), ['class' => '-invers']) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
            {!! HTML::error($errors->first('email')) !!}
        </div>

        <div class="form_group -buttons">
            {!! Form::button( fragment('back.auth.resetPasswordButton'), ['type'=>'submit', 'class'=>'button -default']) !!}
        </div>
        <div class="form_group_help">
            <a href="{{ login_url()  }}">{{ fragment('back.auth.toLogin') }}</a>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection
