@extends('back._layouts.master')

@section('pageTitle', fragment('back.frontUsers.new'))

@section('breadcrumbs', Breadcrumbs::render('newFrontUserBack'))

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment("back.frontUsers.new") }}</h1>

            {!! Form::open([
                'url' => action('Back\FrontUserController@store'),
                'class' =>'-stacked'
            ]) !!}
                @include("back.frontUsers._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection
