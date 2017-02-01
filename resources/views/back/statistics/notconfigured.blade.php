@component('back._layouts.master', [
    'pageTitle' => 'Statistieken',
])

    <section>
        <div class="grid">
            {!! Html::info(fragment('back.statistics.notConfigured')) !!}
        </div>
    </section>

@endcomponent