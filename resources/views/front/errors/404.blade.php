@component('front.layouts.main', [
    'title' => __('error.title'),
])

    <h1>{{ __('error.title') }}</h1>
    <p>
        {{ __('error.text404') }}
    </p>
    <p>
        <a class=button href="{{ route('home') }}">
            {{ __('error.toHome') }}
        </a>
    </p>
@endcomponent
