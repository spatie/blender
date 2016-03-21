@extends('front._layouts.master')

@section('pageTitle', $article->title)
@section('pageDescription', $article->title)

@section('content')

    <h1>{{ $article->title }}</h1>
    @include('front.contact._partials.form')

@endsection
