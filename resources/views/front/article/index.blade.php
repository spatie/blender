@extends('front._layouts.main')

@section('title', $article->seo('title'))
@section('seo', $article->renderSeoTags())

@section('subMenu', Menu::articleSiblings($article))

@section('mainTitle')
    <h1>{{ $article->name }}</h1>
@endsection

@section('mainImages')
    @include('front._partials.images', ['item' => $article])
@endsection

@section('mainContent')
    {!! $article->text !!}
@endsection

@section('mainDownloads')
    @include('front._partials.downloads', ['item' => $article])
@endsection


