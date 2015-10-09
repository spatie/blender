@extends('back.layout.master')

@section('pageTitle', Lang::get('auth.titleLogin'))

@section('content')

<section class="+auth">

    @include('back.layout._partials.flashMessage', ['extraClass' => '-fixed'])

    {{-- @include('auth._partials.lang') --}}
    <div class="+auth_card">
        <h1 class="+auth_title">
            <img class="+auth_logo" src="/images/svg/blender.svg">
            Blender
        </h1>
        {!! Form::open(['class'=>'-stacked +auth_form']) !!}

            <div class="form_group">
                {!! Form::label('email', Lang::get('auth.email'), ['class' => '-invers'] ) !!}
                {!! Form::email('email', Input::old('email'), ['autofocus' => true ]) !!}
                {!! HTML::error($errors->first('email')) !!}
            </div>

            <div class="form_group">
                {!! Form::label('password', Lang::get('auth.password'), ['class' => '-invers']) !!}
                {!! Form::password('password', [ ]) !!}
                {!! HTML::error($errors->first('password')) !!}
                <div class="form_group_help">
                    <a href="{{ URL::to('/'.app()->getLocale().'/password/email') }}">{{ Lang::get('auth.forgotPassword') }}</a>
                </div>
            </div>

            <div class="form_group -buttons">
            {!! Form::button(Lang::get('auth.logIn'), ['type'=>'submit', 'class'=>'button -default']) !!}
            </div>

        {!! Form::close() !!}
    </div>
</section>

<div class="+auth_credit">
    picture: Folkert Gorter
</div>
@endsection
