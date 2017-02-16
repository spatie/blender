<div data-tabs class="tabs">
    <nav class="tabs__menu">
        <ul>
            <li><a href="#content" class="js-tabs-nav"><i class="fa fa-edit"></i> Inhoud</a></li>
            <li><a href="#settings" class="js-tabs-nav"><i class="fa fa-cog"></i> Instellingen</a></li>
            <li><a href="#seo" class="js-tabs-nav"><i class="fa fa-code"></i> SEO</a></li>
        </ul>
    </nav>
    <div id="content">
        {{ html()->translations(function () {
            return [
                html()->formGroup()->required()->text('name', 'Naam'),
                html()->formGroup()->required()->redactor('text', 'Tekst'),
            ];
        }) }}

        {{ html()->media('images', 'images') }}
        {{ html()->media('downloads', 'downloads') }}
    </div>
    <div id="settings">
        @if(! $model->isSpecialArticle())
            {{ html()->formGroup()->checkbox('online', 'Online') }}
        @endif

        {{ html()->formGroup()->searchableSelect('parent_id', 'Kind van...', $parentMenuItems) }}
    </div>
    <div id="seo">
        {{ html()->seo() }}
        {{ html()->info(trans('back.seo.help')) }}
    </div>
</div>
