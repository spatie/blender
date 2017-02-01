@component('front._layouts.main', [
    'title' => fragment('error.title'),
])


    @slot('mainTitle')
        <h1>{{ fragment('error.title') }}</h1>
    @endslot

    <p>
        {{ fragment('error.text.404') }}
    </p>
    <p>
        <a class=button href="{{ route('home') }}">{{ fragment('error.button') }}</a>
    </p>

@endcomponent
