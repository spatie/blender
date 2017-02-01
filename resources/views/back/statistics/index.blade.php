@component('back._layouts.master', [
    'pageTitle' => 'Statistieken',
])

    <section>
        <div class="grid">
            <h1>{{ fragment('back.statistics.title') }}</h1>

            <div class="statistic">
                @include('back.statistics._partials.visitors')
            </div>
            <div class="statistic">
                @include('back.statistics._partials.pages')
            </div>
            <div class="statistic">
                @include('back.statistics._partials.referrers')
            </div>
            <div class="statistic">
                @include('back.statistics._partials.browsers')
            </div>
        </div>
    </section>
@endcomponent
