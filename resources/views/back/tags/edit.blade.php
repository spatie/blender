@extends('back._layouts.master')

@section('breadcrumbs', Html::backToIndex('Back\TagsController@index'))

@section('pageTitle', fragment('back.tags.title'))

@section('content')
<section>
    <div class="grid">
        <h1>{{ $model->name ?: fragment('back.tags.new') }}</h1>

        {!! Form::openDraftable([
            'method'=>'PATCH',
            'action'=> ['Back\TagsController@update', $model->id],
            'class' => '-stacked'
        ], $model) !!}

        @include('back.tags._partials.form')

        {!! Form::close() !!}
    </div>
</section>
@stop
