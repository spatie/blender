<div class="menu">
    <div class="grid">
        <div class="clearfix">
            <nav class="menu__home">

                <a class="menu__home__dashboard" href="{{ URL::action('Back\DashboardController@index') }}">
                    <span class="menu__circle -front"></span>
                    {{ fragment('back.dashboard.title') }}
                </a>

                <a class="menu__home__front" href="{{ URL::to('/') }}" target="blender">
                    <span class="menu__home__front__protocol"><span
                            class="fa {{ Request::isSecure() ? 'fa-lock': 'fa-unlock' }}"></span></span>
                    <span class="menu__home__front__host">{{ Request::getHost() }}</span>
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
