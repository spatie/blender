@extends('back._layouts.main')

@section('title', fragment('error.title') )

@section('content')

    <h1>{{ fragment('error.title') }}</h1>
    <p>
        {{ fragment('error.text.404') }}
    </p>
    <p>
        <a class=button href="/blender">{{ fragment('error.button') }}</a>
    </p>
@endsection
