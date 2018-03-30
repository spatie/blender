{{-- Only render if the site is multilingual and we're on the homepage --}}
@if(! locales()->isEmpty() && request()->path() === locale())
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

    @foreach(locales() as $locale)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ url($locale) }}">
    @endforeach
@endif
