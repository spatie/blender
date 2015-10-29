{{-- Open graph --}}
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="@yield('pageTitle')" />
<meta property="og:description" content="@yield('pageDescription')" />
<meta property="og:image" content="{{ Request::root() }}/images/og-image.png" />
<meta property="og:image:width" content="1600">
<meta property="og:image:height" content="800">
