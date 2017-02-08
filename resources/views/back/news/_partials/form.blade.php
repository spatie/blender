{{ html()
    ->model($model)
    ->form('PATCH', action('Back\NewsController@update', $model->id))
    ->class('-stacked')
    ->open() }}

{{ html()->formGroup()->submit('Bewaar nieuws') }}

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
                html()->formGroup()->text('name', 'Naam'),
                html()->formGroup()->redactor('text', 'Tekst'),
            ];
        }) }}

        {{ html()->formGroup()->category('newsCategory', 'Categorie') }}
        {{ html()->formGroup()->tags('newsTag', 'Tags') }}

        {{--{!! BlenderForm::media('images', 'images') !!}--}}
        {{--{!! BlenderForm::media('downloads', 'downloads') !!}--}}
    </div>
    <div id="settings">
        {{ html()->formGroup()->checkbox('online', 'Online') }}
        {{ html()->formGroup()->date('publish_date', 'Publicatiedatum') }}
    </div>
    <div id="seo">
        {{--{!! BlenderForm::seo() !!}--}}
        {{--{!! Html::info(fragment('back.seo.help')) !!}--}}
    </div>
</div>

{{ html()->formGroup()->submit('Bewaar nieuws') }}

{{ html()->endModel()->form()->close() }}
