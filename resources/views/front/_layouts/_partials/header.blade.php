<header class="header h-padding">
    <div class="grid">
        <div class="grid__col -half">
            <nav class="nav">
                {!! Menu::main() !!}
            </nav>
            @yield('subMenu')
        </div>
        <div class="grid__col -half">
            <nav class="nav h-align-right">
                <ul class="nav__list">
                @if(current_user())
                    <li>
                        <a href="{{ current_user()->getProfileUrl() }}">{{ current_user()->first_name }}</a>
                    </li>
                    <li>
                    @include('front.auth._partials.logoutForm')
                    </li>
                @else
                    <li>
                        <a href="{{ register_url() }}">{{ fragment('auth.register') }}</a>
                    </li>
                    <li>
                        <a href="{{ login_url() }}">{{ fragment('auth.login') }}</a>
                    </li>
                @endif
            </nav>
        </div>
    </div>
</header>
