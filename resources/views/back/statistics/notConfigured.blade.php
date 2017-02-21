@component('back._layouts.master', [
    'title' => __('Statistieken'),
])
    <section>
        <div class="grid">
            {{ html()->info(__('Analytics is nog niet geconfigureerd')) }}
        </div>
    </section>
@endcomponent
