<meta property="og:url" content="@yield('canonical', request()->url())">
<meta property="og:type" content="website">
@if($hasTitle)
    <meta property="og:title" content="@yield('title') - {{ fragment('site.title') }}">
@else
    <meta property="og:title" content="{{ fragment('site.title') }}">
@endif
<meta property="og:description" content="@yield('pageDescription')">
<meta property="og:image" content="{{ request()->root() }}/images/og-image.png">
<meta property="og:image:width" content="1600">
<meta property="og:image:height" content="800">
