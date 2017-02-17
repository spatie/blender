@component('front._layouts.main', [
    'title' => __('error.title'),
])
    @slot('mainTitle')
        <h1>{{ __('error.title') }}</h1>
    @endslot
    <p>
        {{ __('error.text.404') }}
    </p>
    <p>
        <a class=button href="{{ route('home') }}">{{ __('error.button') }}</a>
    </p>
@endcomponent
