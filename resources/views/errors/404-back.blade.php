@component('back._layouts.master', [
    'title' => fragment('error.title'),
])

    <h1>{{ fragment('error.title') }}</h1>
    <p>
        {{ fragment('error.text.404') }}
    </p>
    <p>
        <a class=button href="/blender">{{ fragment('error.button') }}</a>
    </p>

@endcomponent
