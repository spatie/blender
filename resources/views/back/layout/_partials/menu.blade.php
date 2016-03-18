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
                {!! Navigation::getBackUserMenu() !!}
            </nav>
        </div>
        <nav class="menu_main" data-menu-main>
            <ul class="menu_groups" data-menu-groups>
                <li class="menu_group -single">
                    {!! Navigation::getBackDashboardMenu() !!}
                </li>
                <li class="menu_group" data-menu-group="inhoud">
                    {!! Navigation::getBackContentMenu() !!}
                </li>
                <li class="menu_group" data-menu-group="modules">
                    {!! Navigation::getBackModuleMenu() !!}
                </li>
                <li class="menu_group" data-menu-group="configuratie">
                    {!! Navigation::getBackServiceMenu() !!}
                </li>
            </ul>
        </nav>
    </div>
</div>
