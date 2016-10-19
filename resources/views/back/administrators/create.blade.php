@extends('back._layouts.master')

@section('pageTitle', 'Nieuwe gebruiker')

@section('content')
    <section>
        <div class="grid">
            <h1>{{ fragment("back.administrators.new") }}</h1>

            {!! Form::open([
                'url' => action('Back\AdministratorsController@store'),
                'class' =>'-stacked'
            ]) !!}
                @include("back.administrators._partials.form")
            {!! Form::close() !!}
        </div>
    </section>
@endsection
