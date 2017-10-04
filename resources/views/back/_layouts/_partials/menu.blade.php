<div class="menu">
    <div class="grid">
        <div class="clearfix">
            <nav class="menu__home">
                <a class="menu__home__dashboard" href="{{ action('Back\DashboardController@index') }}">
                    <span class="menu__home__dashboard__icon"></span>
                    Dashboard
                </a>
                <a class="menu__home__front" href="{{ url('/') }}" target="blender">
                    <span class="menu__home__front__protocol">
                        <span class="fa {{ Request::isSecure() ? 'fa-lock': 'fa-unlock' }}"></span>
                    </span>
                    <span class="menu__home__front__host">
                        {{ Request::getHost() }}
                    </span>
                </a>
            </nav>
            <nav class="menu__user">
                {!! Menu::backUser() !!}
            </nav>
        </div>
        <nav class="menu__main">
            {!! Menu::backMain() !!}
        </nav>
    </div>
</div>
