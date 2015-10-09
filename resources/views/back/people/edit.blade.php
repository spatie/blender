@extends('back.layout.master')

@section('breadcrumbs', Breadcrumbs::render('personBack', $model))

@section('pageTitle', trans('back-people.title'))

@section('content')
<section>
    <div class="grid">
        <h1>{{ $model->name ?: trans('back-people.new') }}</h1>

        {!! Form::openDraftable(
        [
            'method' =>'PATCH',
            'subject' => $model,
            'action' => ['Back\PersonController@update', $model->id],
            'class' => '-stacked',
        ] ) !!}
        @include('back.people._partials.form')
        {!! Form::close() !!}
    </div>
</section>
@stop
