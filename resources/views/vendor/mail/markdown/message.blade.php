@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' =>  url('/')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @if (isset($subcopy))
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endif

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            {{ date('d/m/Y') }} – <a href="{{ url('/') }}">{{ Request::getHost() }}</a>
        @endcomponent
    @endslot
@endcomponent
