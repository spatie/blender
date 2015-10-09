@extends('back.layout.master')

@section('pageTitle', 'Statistieken')

@section('content')
<section>
    <div class="grid">
        {!! HTML::info(trans('back-statistics.notConfigured')) !!}

@stop