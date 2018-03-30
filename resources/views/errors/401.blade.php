@component('front.layouts.app', [
    'title' => __('error.title'),
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
