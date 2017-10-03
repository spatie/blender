@component('front._layouts.master', [
    'title' => __('Er liep iets mis'),
])
    @slot('mainTitle')
        <h1>{{ __('error.title') }}</h1>
    @endslot

    <p>
        {{ __('error.text401') }}
    </p>
    <p>
        <a class=button href="{{ route('home') }}">
            {{ __('error.toHome') }}
        </a>
    </p>
@endcomponent
