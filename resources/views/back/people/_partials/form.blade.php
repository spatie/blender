{!! BlenderForm::submit() !!}

<div data-tabs class="tabs">
    <nav class="tabs_menu">
        <ul>
            <li><a href="#content" class="js-tabs-nav"><i class="fa fa-edit"></i> Inhoud</a></li>
            <li><a href="#settings" class="js-tabs-nav"><i class="fa fa-cog"></i> Instellingen</a></li>
        </ul>
    </nav>
    <div id="content">
        {!! BlenderForm::text('name') !!}

        {!! BlenderForm::media('images', 'image') !!}
    </div>
    <div id="settings">
        {!! BlenderForm::checkbox('online') !!}
    </div>
</div>

{!! BlenderForm::submit() !!}
