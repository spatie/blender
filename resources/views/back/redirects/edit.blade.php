@extends('back._layouts.master')

@section('breadcrumbs', Breadcrumbs::render('redirectBack', $model))

@section('pageTitle', fragment('back.redirects.title'))

@section('content')
<section>
    <div class="grid">
        <h1>
            {{ $model->old_url ?: fragment('back.redirects.new') }}
        </h1>

        {!! Form::openDraftable([
            'method'=>'PATCH',
            'action'=> ['Back\RedirectController@update', $model->id],
            'class' => '-stacked'
        ], $model) !!}

        @if($model->technical_name && view()->exists("back.redirects._partials.{$model->technical_name}Form"))
            @include("back.redirects._partials.{$model->technical_name}Form")
        @else
            @include('back.redirects._partials.form')
        @endif

        {!! Form::close() !!}

    </div>
</section>
@stop
