@extends('back.layout.master')

@section('breadcrumbs', Breadcrumbs::render('newsItemBack', $model))

@section('pageTitle', trans('back-newsItems.title'))

@section('content')

<section>
    <div class="grid">
        <h1>{{ $model->name ?: trans('back-newsItems.new') }}</h1>

        {!! Form::openDraftable([
                'method'=>'PATCH',
                'subject' => $model,
                'action'=> ['Back\NewsItemController@update', $model->id],
                'class' => '-stacked'
            ]) !!}
        
        @include('back.newsItems._partials.form')
        
        {!! Form::close() !!}
    </div>
</section>

@stop
