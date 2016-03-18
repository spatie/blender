<div class="menu">
    <div class="grid">
        <div class="clearfix">
            <nav class="menu_front">
                <a class="menu_front_link" href="{{ URL::to('/') }}" target="blender">
                    <span class="menu_circle -front"></span>
                    <span class="menu_front_link_host">{{ Request::getHost() }}</span>
                    <span class="menu_front_link_protocol"><span class="fa {{ Request::isSecure() ? 'fa-lock': 'fa-unlock' }}"></span></span>
                </a>
            </nav>
            <nav class="menu_user">
                {!! Menu::backUser() !!}
            </nav>
        </div>
        <nav class="menu_main" data-menu-main>
            {!! Menu::backMain() !!}
        </nav>
    </div>
</div>
