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

    <script src="{{ elixir('back.vendor.js') }}"></script>
    <script src="{{ elixir('back.head.js') }}"></script>

    @include('front.layout._partials.favicons')
</head>
<body>
    @include('front.layout._partials.deprecatedBrowser')

    @if (current_user())
        @include('back.layout._partials.menu')
        <div class="grid">
            @include('back.layout._partials.breadcrumbs')
            @include('back.layout._partials.flashMessage')
        </div>
    @endif
    <main class="main">
        @yield('content')
    </main>
    @if (current_user())
        @include('back.layout._partials.footer')
    @endif
    <script src="{{ elixir('back.app.js') }}" defer></script>
    @yield('extraJs')
</body>
</html>
