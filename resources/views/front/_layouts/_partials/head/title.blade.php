<title>
    @if($hasTitle)
        @yield('title') - {{ fragment('site.title') }}
    @else
        {{ fragment('site.title') }}
    @endif
</title>
