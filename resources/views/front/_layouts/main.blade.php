@component('front._layouts.master', [
    'meta' => $meta ?? []
])
    <main class="p-8" role="main">
        {{ $slot }}
        {{ $mainImages ?? '' }}
        {{ $mainDownloads ?? '' }}
    </main>
@endcomponent
