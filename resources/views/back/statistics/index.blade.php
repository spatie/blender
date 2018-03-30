@component('back.layouts.app', [
    'title' => 'Statistics',
])
    <section>
        <div class="grid">
            <h1>Statistics</h1>

            <div class="statistic">
                @include('back.statistics.partials.visitors')
            </div>

            <div class="statistic">
                @include('back.statistics.partials.pages')
            </div>

            <div class="statistic">
                @include('back.statistics.partials.referrers')
            </div>

            <div class="statistic">
                @include('back.statistics.partials.browsers')
            </div>
        </div>
    </section>
@endcomponent
