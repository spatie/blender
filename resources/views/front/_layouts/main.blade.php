@component('front._layouts.master', [
    'meta' => $meta ?? []
])
    <main class="p-8" role="main">
        {{ $slot }}
    </main>
@endcomponent
