@component('front._layouts.master', [
    'title' => fragment('error.title'),
])

    @slot('mainTitle')
        <h1>{{ fragment('error.title') }}</h1>
    @endslot

    <p>
        {{ fragment('error.text.401') }}
    </p>
    <p>
        <a class=button href="{{ route('home') }}">{{ fragment('error.button') }}</a>
    </p>

@endcomponent
