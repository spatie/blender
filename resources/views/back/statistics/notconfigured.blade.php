@extends('back._layouts.master')

@section('pageTitle', 'Statistieken')

@section('content')
<section>
    <div class="grid">
        {!! Html::info(fragment('back.statistics.notConfigured')) !!}

@stop
