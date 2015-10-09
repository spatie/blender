<!DOCTYPE html>
<html lang="{{ locale() }}">
@include('front.layout._partials.hiddenCredits')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('pageDescription')">

    <title>@yield('pageTitle')</title>

    <link href="{{ elixir('css/front.css') }}" rel="stylesheet">
    @include('front.layout._partials.favicons')
    @include('front.layout._partials.bugsnag')
</head>
<body>
@include('googletagmanager::script')
@include('front.layout._partials.deprecatedBrowser')

<header>

</header>

<main>

    {!! Navigation::getFrontMainMenu() !!}

    @include('front.layout._partials.flashMessage')

    @yield('content')

</main>

<footer>
    <small>
        © {{ Date('Y') }} <a href="https://spatie.be">spatie.be webdesign, Antwerpen</a>
    </small>
</footer>

<script src="{{ elixir('js/front.app.js') }}" defer></script>
</body>
</html>
