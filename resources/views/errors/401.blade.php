@extends('front._layouts.main')

@section('title', fragment('error.title') )

@section('mainTitle')
    <h1>{{ fragment('error.title') }}</h1>
@endsection

@section('mainContent')
    <p>
        {{ fragment('error.text.401') }}
    </p>
    <p>
        <a class=button href="{{ route('home') }}">{{ fragment('error.button') }}</a>
    </p>
@endsection
