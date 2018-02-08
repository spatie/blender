<!DOCTYPE html>
<html lang="{{ locale() }}" data-viewport>
@include('front._layouts._partials.hiddenCredits')
<head>
    @include('front._layouts._partials.head.meta')

    <link rel="stylesheet" href="{{ mix('css/front.css') }}">

    <script defer src="{{ mix('js/front.app.js') }}"></script>

    @include('front._layouts._partials.head.seo')
    @include('front._layouts._partials.head.hreflang')
    @include('front._layouts._partials.head.favicons')
    @include('front._layouts._partials.head.bugsnag')
</head>
<body>
    @include('googletagmanager::script')

    @include('front._layouts._partials.header')
    @include('front._layouts._partials.flashMessage')

    {{ $slot }}

    @include('cookieConsent::index')
    @include('front._layouts._partials.footer')

</body>
</html>
