<header class="header h-padding">
    <div class=layout>
        <div class="grid">
            <div class="grid__cell -width-1/2">
                <nav class="nav">
                    {{ Menu::main() }}
                </nav>
                @yield('subMenu')
            </div>
            <div class="grid__cell -width-1/2">
                <nav class="nav h-align-right">
                    <ul class="nav__list">
                        {{-- @auth
                            <li>
                                <a href="{{ current_user()->getProfileUrl() }}">
                                    {{ current_user()->first_name }}
                                </a>
                            </li>
                            <li>
                                @include('front.auth._partials.logoutForm')
                            </li>
                        @else
                            <li>
                                <a href="{{ route('register') }}">{{ __('auth.register') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
                            </li>
                        @endauth --}}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
