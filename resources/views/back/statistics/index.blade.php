@component('back._layouts.master', [
    'title' => 'Statistics',
])
    <section>
        <div class="grid">
            <h1>Statistics</h1>

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
