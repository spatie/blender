@component('back._layouts.master', [
    'title' => __('Er liep iets mis'),
])
    <section>
        <div class="grid">
            <h1>@lang('Er liep iets mis')</h1>
            <p>
                @lang('Deze pagina kon niet gevonden worden')
            </p>
            <p>
                <a class=button href="/blender">@lang('Terug naar Blender')</a>
            </p>
        </div>
    </section>
@endcomponent
