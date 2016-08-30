@extends('front._layouts.master')

@section('title', $article->seo('title'))
@section('meta', $article->renderMetaTags())

@section('subMenu', Menu::articleSiblings($article))

@section('content')

    @include('front._layouts.article')

@endsection
