<header class="flex p-8 bg-grey-light text-grey-dark">
    <nav class="nav">
        {{ Menu::main() }}
        @yield('subMenu')
    </nav>
    <ul class="flex">
        {{-- @auth
            <li>
                <a href="{{ current_user()->getProfileUrl() }}">
                    {{ current_user()->first_name }}
                </a>
            </li>
            <li>
                @include('front.auth.partials.logoutForm')
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
</header>
