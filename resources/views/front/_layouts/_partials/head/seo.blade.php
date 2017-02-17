@section('seo')
    <meta name="description" content="@yield('pageDescription')">

    <meta property="og:url" content="@yield('canonical', request()->url())">
    <meta property="og:type" content="website">
    @if($hasTitle)
        <meta property="og:title" content="@yield('title') - @lang('site.title')">
    @else
        <meta property="og:title" content="@lang('site.title')">
    @endif
    <meta property="og:description" content="@yield('pageDescription')">
    <meta property="og:image" content="{{ url('/images/og-image.png') }}">
@show
