@extends('back._layouts.master')

@section('pageTitle', $user->email)

@section('breadcrumbs', Breadcrumbs::render('membersEditBack', $user))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment('back.members.member') }} {{ $user->email }}</h1>
            {!! Form::model(
                $user,
                ['method' => 'PATCH', 'action' => ['Back\MembersController@update', $user->id] ,
                'class' => '-stacked'
            ]) !!}
                @include("back.members._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection
