@component('front._layouts.master', [
    'title' => $title
])

    <main class="h-padding-medium">
        <div class="grid">
            <div class="grid__col">
                {{ $mainTitle ?? '' }}

                {{ $mainImages ?? '' }}

                {{ $slot ?? '' }}

                {{ $mainDownloads ?? '' }}
            </div>
        </div>
    </main>
@endcomponent
