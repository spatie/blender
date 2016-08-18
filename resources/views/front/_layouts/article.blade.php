@extends('front._layouts.master')

@section('title', $article->name)
@section('meta', $article->renderMetaTags())

@section('content')

    <h1>{{ $article->name }}</h1>

    @if($cover = $article->getFirstMedia('images'))
        <img src="{{ $cover->getUrl('thumb') }}" alt="{{ $cover->name }}">
    @endif

    {!! $article->text !!}

    @include('front._partials.downloads', ['item' => $article])

@endsection
