<div class="menu">
    <div class="grid">
        <div class="clearfix">
            <span class="menu_front">
                <a class="menu_front_link" href="{{ URL::to('/') }}" target="blender">
                    <span class="menu_circle -front"></span>
                    <span class="menu_front_link_protocol"><span class="fa {{ Request::isSecure() ? 'fa-lock': 'fa-unlock' }}"></span></span>
                    <span class="menu_front_link_host">{{ Request::getHost() }}</span>
                </a>
            </span>
            <nav class="menu_user">
                {!! Navigation::getBackUserMenu() !!}
            </nav>
        </div>

        <nav class="menu_main">
            <div class="menu_group">
                {!! Navigation::getBackDashboardMenu() !!}
            </div>
            <div class="menu_group">
                {!! Navigation::getBackMainMenu() !!}
            </div>
        </nav>
    </div>
</div>
