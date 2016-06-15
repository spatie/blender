<div class="menu">
    <div class="grid">
        <div class="clearfix">
            <nav class="menu_home">

                <a class="menu_home_dashboard" href="{{ URL::action('Back\DashboardController@index') }}">
                    <span class="menu_circle -front"></span>
                    {{ fragment('back.dashboard.title') }}
                </a>

                <a class="menu_home_front" href="{{ URL::to('/') }}" target="blender">
                    <span class="menu_home_front_protocol"><span
                            class="fa {{ Request::isSecure() ? 'fa-lock': 'fa-unlock' }}"></span></span>
                    <span class="menu_home_front_host">{{ Request::getHost() }}</span>
                </a>

            </nav>
            <nav class="menu_user">
                {!! Menu::backUser() !!}
            </nav>
        </div>
        <nav class="menu_main">
            {!! Menu::backMain() !!}
        </nav>
    </div>
</div>
