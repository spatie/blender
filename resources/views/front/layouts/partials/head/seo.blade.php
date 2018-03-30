@php
    meta()->defaultTitle(__('site.title'));
    meta()->suffixTitleWith(' - '.__('site.title'));
    meta()->with($meta ?? []);
@endphp

<title>{{ meta()->title() }}</title>

{{ meta()->with([
    'description' => __('site.description'),
    'og:url' => request()->url(),
    'og:title' => meta()->title(),
    'og:description' => __('site.description'),
    'og:type' => 'website',
    'og:image' => url('/images/og-image.png'),
])->with($meta ?? []) }}
