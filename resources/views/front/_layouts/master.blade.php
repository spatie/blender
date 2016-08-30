<!DOCTYPE html>
<html lang="{{ locale() }}" data-viewport>
@include('front._layouts._partials.hiddenCredits')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    @include('front._layouts._partials.hreflang')
    @include('front._layouts._partials.meta')
    @include('front._layouts._partials.favicons')
    @include('front._layouts._partials.bugsnag')
</head>
<body>
    @include('googletagmanager::script')
    @include('front._layouts._partials.deprecatedBrowser')
    <header class="header">
        <div class="grid">
            <div class="grid_col -width-1/2">
                <nav class="nav">
                    {!! Menu::main() !!}
                </nav>
                @yield('subMenu')
            </div>
            <div class="grid_col -width-1/2">
                <nav class="nav :align-right">
                    @if(current_user())
                       <a href="{{ current_user()->getProfileUrl() }}">{{ current_user()->first_name }}</a> •
                        @include('front.auth._partials.logoutForm')
                    @else
                       <a href="{{ register_url() }}">{{ fragment('auth.register') }}</a> • <a href="{{ login_url() }}">{{ fragment('auth.login') }}</a>
                    @endif
                </nav>
            </div>
        </div>
    </header>
    @include('front._layouts._partials.flashMessage')
    @yield('content')
    @include('cookieConsent::index')
    <footer class="footer">
        <small>
            © {{ Date('Y') }} <a href="https://spatie.be">spatie.be webdesign, Antwerpen</a>
        </small>
    </footer>
    <script src="{{ elixir('front.app.js') }}"></script>

</body>
</html>
