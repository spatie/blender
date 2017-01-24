<!DOCTYPE html>
<html lang="{{ locale() }}" data-viewport>
@include('front._layouts._partials.hiddenCredits')
<head>
    @include('front._layouts._partials.head.meta')

    <link rel="stylesheet" href="{{ elixir('front.style.css') }}">
    <script src="{{ elixir('front.head.js') }}"></script>

    <title>{{ isset($title) ? $title  . ' - ' : '' }} {{ fragment('site.title') }}</title>

    @include('front._layouts._partials.head.seo')
    @include('front._layouts._partials.head.hreflang')
    @include('front._layouts._partials.head.favicons')
    @include('front._layouts._partials.head.bugsnag')
</head>
<body>
    @include('googletagmanager::script')
    @include('front._layouts._partials.deprecatedBrowser')

    @include('front._layouts._partials.header')
    @include('front._layouts._partials.flashMessage')

    {{ $slot }}

    @include('cookieConsent::index')
    @include('front._layouts._partials.footer')

    <script src="{{ elixir('front.app.js') }}"></script>

</body>
</html>
