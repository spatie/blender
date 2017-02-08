{{ html()->model($model)->form('PATCH')->class('-stacked')->open() }}

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
                html()->text('name'),
                html()->redactor('text'),
            ];
        }) }}

        {{--{!! BlenderForm::category('news_category') !!}--}}
        {{--{!! BlenderForm::tags('news_tag') !!}--}}

        {{--{!! BlenderForm::media('images', 'images') !!}--}}
        {{--{!! BlenderForm::media('downloads', 'downloads') !!}--}}
    </div>
    <div id="settings">
        {{--{!! BlenderForm::checkbox('online') !!}--}}

        {{--{!! BlenderForm::date('publish_date') !!}--}}
    </div>
    <div id="seo">
        {{--{!! BlenderForm::seo() !!}--}}
        {{--{!! Html::info(fragment('back.seo.help')) !!}--}}
    </div>
</div>

{{--{!! BlenderForm::submit() !!}--}}

{{ html()->endModel()->form()->close() }}
