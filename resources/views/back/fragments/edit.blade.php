@extends('back._layouts.master')

@section('pageTitle', 'Wijzig vaste tekst')

@section('breadcrumbs', Html::backToIndex('Back\FragmentsController@index'))

@section('content')
<section>
    <div class="grid">
        <h1 class=":text-ellipsis">{{ $fragment->name }}</h1>

        @if( app()->getLocale() == 'nl')
        <div class="alerts">
            {!! Html::info($fragment->description, '-small -inline') !!}
        </div>
        @endif

        {!! Form::open([
            'method'=>'PATCH',
            'action' => ['Back\FragmentsController@update', $fragment->id],
            'class' =>'-stacked']
        ) !!}
        @include('back.fragments._partials.form')
        {!! Form::close() !!}
    </div>
</section>
@stop
