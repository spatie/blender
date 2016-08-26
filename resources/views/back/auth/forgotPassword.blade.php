@extends('back._layouts.master')

@section('pageTitle', fragment('back.auth.titleResetPassword'))

@section('content')
<section class="+auth">
    {{-- @include('auth._partials.lang') --}}

    @include('back._layouts._partials.flashMessage', ['extraClass' => '-fixed'])

    <div class="+auth_card">
        {!! Form::open(['class'=>'-stacked +auth_form']) !!}
        <h1 class="+auth_title -small">{{ fragment('back.auth.resetPassword.title') }}</h1>
        @if(session('status'))
            <p class="alert -info">
                {{ session('status') }}
            </p>
        @else
        <p class="alert -info">
            {{ fragment('back.auth.resetPassword.intro') }}
        </p>
        @endif
        <div class="form_group">
            {!! Form::label('email', fragment('back.auth.email')) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
            {!! Html::error($errors->first('email')) !!}
        </div>

        <div class="form_group -buttons">
            {!! Form::button( fragment('back.auth.resetPassword.button'), ['type'=>'submit', 'class'=>'button -default']) !!}
        </div>
        <div class="form_group_help">
            <a href="{{ login_url()  }}">{{ fragment('back.auth.toLogin') }}</a>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection
