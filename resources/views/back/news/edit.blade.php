@extends('back._layouts.master')

@section('breadcrumbs', Breadcrumbs::render('newsBack', $model))

@section('pageTitle', fragment('back.news.title'))

@section('content')

<section>
    <div class="grid">
        <h1>{!! Html::onlineIndicator($model->online) !!}{{ $model->name ?: fragment('back.news.new') }}</h1>

        {!! Form::openDraftable([
            'method'=>'PATCH',
            'action'=> ['Back\NewsController@update', $model->id],
            'class' => '-stacked'
        ], $model) !!}

        @include('back.news._partials.form')

        {!! Form::close() !!}
    </div>
</section>

@stop
