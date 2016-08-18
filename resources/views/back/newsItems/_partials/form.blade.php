{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::translated([
    'name' => 'text',
    'text' => 'redactor',
]) !!}

{!! BlenderForm::date('publish_date') !!}

{!! BlenderForm::category('news_category') !!}
{!! BlenderForm::tags('news_tag') !!}

{!! BlenderForm::media('images', 'images') !!}
{!! BlenderForm::media('downloads', 'downloads') !!}

{!! BlenderForm::meta() !!}

{!! BlenderForm::submit() !!}
