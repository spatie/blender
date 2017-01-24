<!DOCTYPE html>
<html lang="{{ locale() }}">
@include('front._layouts._partials.hiddenCredits')
<head>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('pageDescription')">
    <title>{{ isset($pageTitle) ? $pageTitle  . ' | ' : '' }} Blender</title>

    <link rel="stylesheet" href="{{ elixir('back.style.css') }}">

    <script src="{{ elixir('back.head.js') }}"></script>

    @include('front._layouts._partials.head.favicons')
</head>
<body>
    @include('front._layouts._partials.deprecatedBrowser')

    @if (current_user())
        @include('back._layouts._partials.menu')
        <div class="grid">
            @include('back._layouts._partials.flashMessage')
            <nav class="breadcrumbs">
                {{ $breadcrumbs ?? '' }}
            </nav>
        </div>
    @endif
    <main class="main" id="app">
        {{ $slot }}
    </main>
    @if (current_user())
        @include('back._layouts._partials.footer')
    @endif
    <script src="{{ elixir('back.app.js') }}" defer></script>
    @yield('extraJs')
</body>
</html>
