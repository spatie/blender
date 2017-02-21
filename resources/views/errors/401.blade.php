@component('front._layouts.master', [
    'title' => __('Er liep iets mis'),
])
    @slot('mainTitle')
        <h1>@lang('Er liep iets mis')</h1>
    @endslot

    <p>
        @lang('U heeft geen toegang tot deze pagina')
    </p>
    <p>
        <a class=button href="{{ route('home') }}">@lang('Naar home')</a>
    </p>
@endcomponent
