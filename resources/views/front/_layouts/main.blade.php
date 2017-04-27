@component('front._layouts.master', [
    'meta' => $meta ?? []
])
    {{ $mainImages ?? '' }}

    <main class="main h-padding-medium">
        <div class="layout">
            <div class="grid">
                <div class="grid__cell">
                    <article class="article has-html">
                        {{ $mainTitle ?? '' }}

                        {{ $slot }}

                        {{ $mainDownloads ?? '' }}
                    </article>
                </div>
            </div>
        </div>
    </main>
@endcomponent
