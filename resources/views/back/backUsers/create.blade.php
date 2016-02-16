@extends('back.layout.master')

@section('pageTitle', 'Nieuwe gebruiker')

@section('breadcrumbs', Breadcrumbs::render('newBackUserBack'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ trans("back-backUsers.new") }}</h1>

            {!! Form::open([
                'url' => action('Back\BackUserController@store'),
                'class' =>'-stacked'
            ]) !!}
                @include("back.backUsers._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection
