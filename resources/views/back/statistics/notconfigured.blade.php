@extends('back._layouts.master')

@section('pageTitle', 'Statistieken')

@section('content')
<section>
    <div class="grid">
        {!! HTML::info(fragment('back.statistics.notConfigured')) !!}

@stop
