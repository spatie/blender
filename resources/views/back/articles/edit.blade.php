@extends('back._layouts.master')

@section('breadcrumbs', '')

@section('pageTitle', fragment('back.articles.title'))

@section('content')
<section>
    <div class="grid">
    <h1>{!! Html::onlineIndicator($model->online) !!}{{ $model->name ?: fragment('back.articles.new') }}</h1>

    {!! Form::openDraftable([
        'method'=>'PATCH',
        'action'=> ['Back\ArticlesController@update', $model->id],
        'class' => '-stacked'
    ], $model) !!}

    @if($model->technical_name && view()->exists("back.articles._partials.{$model->technical_name}Form"))
        @include("back.articles._partials.{$model->technical_name}Form")
    @else
        @include('back.articles._partials.form')
    @endif

    {!! Form::close() !!}

    </div>
</section>
@stop
