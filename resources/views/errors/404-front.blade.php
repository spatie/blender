@component('front._layouts.main', [
    'title' => trans('error.title'),
])
    @slot('mainTitle')
        <h1>{{ trans('error.title') }}</h1>
    @endslot
    <p>
        {{ trans('error.text.404') }}
    </p>
    <p>
        <a class=button href="{{ route('home') }}">{{ trans('error.button') }}</a>
    </p>
@endcomponent
