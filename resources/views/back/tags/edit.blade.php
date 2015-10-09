@extends('back.layout.master')

@section('breadcrumbs', Breadcrumbs::render('tagBack', $model))

@section('pageTitle', trans('back-tags.title'))

@section('content')
<section>
    <div class="grid">
    <h1>{{ $model->name ?: trans('back-tags.new') }}</h1>

        {!! Form::openDraftable(
            [
            'method'=>'PATCH',
            'action'=> ['Back\TagController@update', $model->id],
            'subject' => $model,
            'class' => '-stacked'
            ]
        ) !!}
    @include('back.tags._partials.form')
    {!! Form::close() !!}

    </div>
</section>
@stop
