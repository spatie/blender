@extends('front._layouts.master')

@section('title', $article->name)
@section('metaDescription', $article->present()->meta())

@section('content')

    <h1>{{ $article->title }}</h1>
    @include('front.contact._partials.form')

@endsection
