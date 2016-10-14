@extends('front._layouts.main')

@section('title', $article->seo('title'))
@section('seo', $article->renderSeoTags())

@section('mainTitle')
    <h1>{{ $article->name }}</h1>
@endsection

@section('mainImages')
    @if($cover = $article->getFirstMedia('images'))
        <img src="{{ $cover->getUrl('thumb') }}" alt="{{ $cover->name }}">
    @endif
@endsection

@section('mainContent')
    {!! $article->text !!}
@endsection
