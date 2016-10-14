@extends('front._layouts.main')

@section('title', $article->seo('title'))
@section('seo', $article->renderSeoTags())

@section('mainTitle')
    <h1>{{ $article->name }}</h1>
@endsection

@section('mainContent')
    @include('front.contact._partials.form')
@endsection
