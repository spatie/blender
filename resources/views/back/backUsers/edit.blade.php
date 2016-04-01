@extends('back._layouts.master')

@section('pageTitle', $user->email)

@section('breadcrumbs', Breadcrumbs::render('editBackUserBack', $user))

@section('content')
    <section>
        <div class="grid">
            <h1>Administrator {{ $user->email }}</h1>
            <div>
                {!! HTML::avatar($user) !!}
                <span class="help -small">
                    {{ fragment('back.backUsers.gravatarInfo') }} <a href="https://gravatar.com">gravatar.com</a>
                </span>
            </div>
            {!! Form::model(
                $user,
                ['method' => 'PATCH', 'action' => ['Back\BackUserController@update', $user->id] ,
                'class' => '-stacked'
            ]) !!}
                @include("back.backUsers._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection
