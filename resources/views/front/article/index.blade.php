@extends('front._layouts.master')

@section('title', $article->name)

@section('subMenu', Menu::articleSiblings($article))

@section('content')

    @include('front._layouts.article')

@endsection
