@extends('back._layouts.master')

@section('breadcrumbs', Breadcrumbs::render('personBack', $model))

@section('pageTitle', fragment('back.people.title'))

@section('content')
<section>
    <div class="grid">
        <h1>{{ $model->name ?: fragment('back.people.new') }} {!! Html::onlineIndicator($model->online) !!}</h1>

        {!! Form::openDraftable([
            'method' =>'PATCH',
            'action' => ['Back\PersonController@update', $model->id],
            'class' => '-stacked',
        ], $model) !!}

        @include('back.people._partials.form')

        {!! Form::close() !!}
    </div>
</section>
@stop
