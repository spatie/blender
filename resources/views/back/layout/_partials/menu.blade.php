<div class="menu">
    <div class="grid">
        <span class="menu_brand">
            <img src="/images/svg/blender.svg" class="menu_brand_logo">
            <a href="{{ URL::to('/blender') }}" class="menu_brand_name">Blender 5</a>
        </span>

        <nav class="menu_user">
            {!! Navigation::getBackUserMenu() !!}
        </nav>

        <nav class="menu_main">
            <div class="menu_group">
                {!! Navigation::getBackDashboardMenu() !!}
            </div>
            <div class="menu_group">
                {!! Navigation::getBackMainMenu() !!}
            </div>
            <div class="menu_group -right">
                {!! Navigation::getBackServiceMenu() !!}
            </div>
        </nav>
    </div>
</div>