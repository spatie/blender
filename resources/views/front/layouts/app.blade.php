<!DOCTYPE html>
<html lang="{{ locale() }}" data-viewport>
@include('front.layouts.partials.hiddenCredits')
<head>
    @include('front.layouts.partials.head.meta')

    <link rel="stylesheet" href="{{ mix('css/front.css') }}">

    <script defer src="{{ mix('js/front.app.js') }}"></script>

    @include('front.layouts.partials.head.seo')
    @include('front.layouts.partials.head.hreflang')
    @include('front.layouts.partials.head.favicons')
    @include('front.layouts.partials.head.bugsnag')
</head>
<body>
    @include('googletagmanager::script')

    @include('front.layouts.partials.header')
    @include('front.layouts.partials.flashMessage')

    {{ $slot }}

    @include('cookieConsent::index')
    @include('front.layouts.partials.footer')

</body>
</html>
