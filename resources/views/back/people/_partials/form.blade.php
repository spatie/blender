<div data-tabs class="tabs">
    <nav class="tabs__menu">
        <ul>
            <li><a href="#content" class="js-tabs-nav"><i class="fa fa-edit"></i> Content</a></li>
            <li><a href="#settings" class="js-tabs-nav"><i class="fa fa-cog"></i> Settings</a></li>
        </ul>
    </nav>
    <div id="content">
        {{ html()->formGroup()->text('name', 'Name') }}

        {{ html()->formGroup()->media('images', 'image', 'Image') }}
    </div>
    <div id="settings">
        {{ html()->formGroup()->checkbox('online', 'Online') }}
    </div>
</div>
