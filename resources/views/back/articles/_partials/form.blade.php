{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::translated([
    'name' => 'text',
    'text' => 'redactor',
]) !!}

{!! BlenderForm::date('publish_date') !!}

{!! BlenderForm::media('images', 'images') !!}
{!! BlenderForm::media('downloads', 'downloads') !!}

{!! BlenderForm::submit() !!}
