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

    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900,300italic' rel='stylesheet' type='text/css'>

    @if(! app()->environment('production'))
        <script src="{{ elixir('back.style.js') }}"></script>
    @else
        <link rel="stylesheet" href="{{ elixir('back.style.css') }}">
    @endif

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
    <script src="{{ elixir('back.app.js') }}"></script>
    @yield('extraJs')
    <script src="/redactor/redactor.min.js"></script>
    <script src="/redactor/imagemanager.js"></script>
    <script src="/redactor/video.js"></script>
</body>
</html>
