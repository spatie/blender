<!DOCTYPE html>
<html lang="{{ locale() }}"
      data-viewport
      data-viewport-small="900"
      data-viewport-start="100"
      data-viewport-end="100">
@include('front.layout._partials.hiddenCredits')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="@yield('metaDescription', fragment('site.description'))">
    <link rel="canonical" href="@yield('canonical', request()->url())" />

    <title>
        @if($hasTitle)
            @yield('title') - {{ fragment('site.title') }}
        @else
            {{ fragment('site.title') }}
        @endif
    </title>

    @if(! app()->environment('production'))
        <script src="{{ elixir('front.style.js') }}"></script>
    @else
        <link rel="stylesheet" href="{{ elixir('front.style.css') }}">
    @endif

    <script src="{{ elixir('front.head.js') }}"></script>

    @include('front.layout._partials.openGraph')
    @include('front.layout._partials.favicons')
    @include('front.layout._partials.bugsnag')
</head>
<body>
    @include('googletagmanager::script')
    @include('front.layout._partials.deprecatedBrowser')
    <header class="header">
        <div class="grid">
            <nav class="nav grid_col -width-1/2">
                {!! Navigation::getFrontMainMenu() !!}
            </nav>
            <nav class="nav :align-right grid_col -width-1/2 -last">
                @if(current_user())
                Hey, {{ current_user()->first_name }} — <a href="{{ logout_url() }}">Uitloggen</a>
                @else
                <a href="{{ login_url() }}">Inloggen</a>
                @endif
            </nav>
        </div>
    </header>
    @include('front.layout._partials.flashMessage')
    @yield('content')
    <footer class="footer">
        <small>
            © {{ Date('Y') }} <a href="https://spatie.be">spatie.be webdesign, Antwerpen</a>
        </small>
    </footer>
    <script src="{{ elixir('front.app.js') }}"></script>
</body>
</html>
