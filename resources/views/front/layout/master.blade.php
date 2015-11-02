<!DOCTYPE html>
<html lang="{{ locale() }}"
      data-viewport-breakpoint="900"
      data-viewport-scroll-treshold="100">
@include('front.layout._partials.hiddenCredits')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('pageDescription')">

    <title>@yield('pageTitle')</title>

    <link href="{{ elixir('css/front.css') }}" rel="stylesheet">
    @include('front.layout._partials.openGraph')
    @include('front.layout._partials.favicons')
    @include('front.layout._partials.bugsnag')
</head>
<body>
@include('googletagmanager::script')
@include('front.layout._partials.deprecatedBrowser')

<header class="header">
    <div class="grid">
        <nav class="nav">
            {!! Navigation::getFrontMainMenu() !!}
        </nav>
    </div>
</header>

@include('front.layout._partials.flashMessage')
@yield('content')

<footer class="footer">
    <small>
        © {{ Date('Y') }} <a href="https://spatie.be">spatie.be webdesign, Antwerpen</a>
    </small>
</footer>
<script src="{{ elixir('js/front.app.js') }}" defer></script>
</body>
</html>
