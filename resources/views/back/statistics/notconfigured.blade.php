@extends('back.layout.master')

@section('pageTitle', 'Statistieken')

@section('content')
<section>
    <div class="grid">
        {!! HTML::info(fragment('back.statistics.notConfigured')) !!}

@stop
