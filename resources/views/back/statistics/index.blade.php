@extends('back._layouts.master')

@section('pageTitle', 'Statistieken')

@section('content')
<section>
    <div class="grid">
        <h1>{{ fragment('back.statistics.title') }}</h1>

        <div class="statistic">
            @include('back.statistics._partials.visitors')
        </div>
        <div class="statistic">
            @include('back.statistics._partials.pages')
        </div>
        <div class="statistic">
            @include('back.statistics._partials.keywords')
        </div>
        <div class="statistic">
            @include('back.statistics._partials.referrers')
        </div>
        <div class="statistic">
            @include('back.statistics._partials.browsers')
        </div>
    </div>
</section>
@stop
