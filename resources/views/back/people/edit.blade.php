@extends('back._layouts.master')

@section('breadcrumbs', Breadcrumbs::render('personBack', $model))

@section('pageTitle', fragment('back.people.title'))

@section('content')
<section>
    <div class="grid">
        <h1>{{ $model->name ?: fragment('back.people.new') }}</h1>

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
