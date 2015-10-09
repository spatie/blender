@extends('front.layout.master')

@section('pageTitle', $article->title)
@section('metaDescription', $article->title)

@section('content')

    <h1>{{ $article->title }}</h1>
    @include('front.contact._partials.form')

@endsection
