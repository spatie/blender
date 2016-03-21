@extends('back._layouts.master')

@section('pageTitle', $user->email)

@section('breadcrumbs', Breadcrumbs::render('editFrontUserBack', $user))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment('back.frontUsers.member') }} {{ $user->email }}</h1>
            {!! Form::model(
                $user,
                ['method' => 'PATCH', 'action' => ['Back\FrontUserController@update', $user->id] ,
                'class' => '-stacked'
            ]) !!}
                @include("back.frontUsers._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection
