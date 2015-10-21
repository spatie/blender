<!DOCTYPE html>
<html lang="{{ locale() }}">
@include('front.layout._partials.hiddenCredits')
<head>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('pageDescription')">
    <title>@yield('pageTitle')</title>

    {{-- Fonts & styles --}}
    <link href="{{ elixir('css/back.css') }}" rel="stylesheet" />

    {{-- Script --}}

    {{-- Favicon --}}
    @include('front.layout._partials.favicons')

</head>
<body>

    @if (auth()->user())
        @include('back.layout._partials.menu')

        <div class="grid">
            @include('back.layout._partials.breadcrumbs')
            @include('back.layout._partials.flashMessage')
        </div>
    @endif

    <main class="main">
        @yield('content')
    </main>

    @if (auth()->user())
        @include('back.layout._partials.footer')
    @endif

{{-- Scripts --}}
<script src="{{ elixir('js/back.app.js') }}" ></script>
@yield('extraJs')

{{-- redactor--}}
<script src="/redactor/redactor.min.js"></script>
<script src="/redactor/imagemanager.js"></script>
<script src="/redactor/video.js"></script>
<script src="/redactor/redactor.init.js"></script>


</body>
</html>
