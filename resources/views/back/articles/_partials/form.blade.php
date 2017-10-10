<div data-tabs class="tabs">
    <nav class="tabs__menu">
        <ul>
            <li><a href="#content" class="js-tabs-nav"><i class="fa fa-edit"></i> Content</a></li>
            <li><a href="#blocks" class="js-tabs-nav"><i class="fa fa-cube"></i> Blocks</a></li>
            <li><a href="#settings" class="js-tabs-nav"><i class="fa fa-cog"></i> Settings</a></li>
            <li><a href="#seo" class="js-tabs-nav"><i class="fa fa-code"></i> SEO</a></li>
        </ul>
    </nav>
    <div id="content">
        {{ html()->translations(function () {
            return [
                html()->formGroup()->required()->text('name', 'Name'),
                html()->formGroup()->required()->redactor('text', 'Text'),
            ];
        }) }}

        {{ html()->formGroup()->media('images', 'images', 'Images') }}
        {{ html()->formGroup()->media('downloads', 'downloads', 'Downloads') }}
    </div>
    <div id="blocks">
        {{ html()->formGroup()->contentBlocks('default', 'Blocks', [
            'types' => [
                'image_left' => 'Block with an image to the left',
                'image_right' => 'Block with an image to the right',
            ],
            'translatableAttributes' => [
                'name' => 'text',
                'text' => 'redactor',
            ],
            'mediaLibraryCollections' => [
                'images' => 'images',
            ],
            'labels' => [
                'images' => 'Image(s)',
            ],
        ]) }}
    </div>
    <div id="settings">
        @if(! $model->isSpecialArticle())
            {{ html()->formGroup()->checkbox('online', 'Online') }}
        @endif

        {{ html()->formGroup()->searchableSelect('parent_id', 'Parent article', $parentMenuItems) }}
    </div>
    <div id="seo">
        {{ html()->seo() }}

        <div class="alert--info">
            We automatically determine these fields' contents. You can override them here if you need something special.
        </div>
    </div>
</div>
