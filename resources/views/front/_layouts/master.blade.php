<!DOCTYPE html>
<html lang="{{ locale() }}" data-viewport>
@include('front._layouts._partials.hiddenCredits')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="canonical" href="@yield('canonical', request()->url())" />

    <title>
        @if($hasTitle)
            @yield('title') - {{ fragment('site.title') }}
        @else
            {{ fragment('site.title') }}
        @endif
    </title>

    <link rel="stylesheet" href="{{ elixir('front.style.css') }}">

    <script src="{{ elixir('front.head.js') }}"></script>

    @include('front._layouts._partials.hreflang')
    @include('front._layouts._partials.meta')
    @include('front._layouts._partials.favicons')
    @include('front._layouts._partials.bugsnag')
</head>
<body>
    @include('googletagmanager::script')
    @include('front._layouts._partials.deprecatedBrowser')

    @include('front._layouts._partials.header')
    @include('front._layouts._partials.flashMessage')
    @yield('main')
    @include('cookieConsent::index')
    @include('front._layouts._partials.footer')

    <script src="{{ elixir('front.app.js') }}"></script>

</body>
</html>
