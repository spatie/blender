@extends('back._layouts.master')

@section('breadcrumbs', Html::backToIndex('Back\PeopleController@index'))

@section('pageTitle', fragment('back.people.title'))

@section('content')
<section>
    <div class="grid">
        <h1>{!! Html::onlineIndicator($model->online) !!}{{ $model->name ?: fragment('back.people.new') }}</h1>

        {!! Form::openDraftable([
            'method' =>'PATCH',
            'action' => ['Back\PeopleController@update', $model->id],
            'class' => '-stacked',
        ], $model) !!}

        @include('back.people._partials.form')

        {!! Form::close() !!}
    </div>
</section>
@stop
