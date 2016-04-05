@extends('back._layouts.master')

@section('breadcrumbs', Breadcrumbs::render('newsItemBack', $model))

@section('pageTitle', fragment('back.newsItems.title'))

@section('content')

<section>
    <div class="grid">
        <h1>{{ $model->name ?: fragment('back.newsItems.new') }}</h1>

        {!! Form::openDraftable([
            'method'=>'PATCH',
            'action'=> ['Back\NewsItemController@update', $model->id],
            'class' => '-stacked'
        ], $model) !!}

        @include('back.newsItems._partials.form')

        {!! Form::close() !!}
    </div>
</section>

@stop
