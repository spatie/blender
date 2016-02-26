<?php
$locales = collect(config('app.locales'));
$current = locale();
?>

{{-- Only render if the site is multilingual and we're on the homepage --}}
@if($locales->count() > 1 && request()->path() === $current)
    @foreach($locales->diff([$current]) as $locale)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ url($locale) }}">
    @endforeach
@endif
