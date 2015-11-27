{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::translated([
    'name' => 'text',
    'text' => 'redactor',
]) !!}

{!! BlenderForm::media('images', 'images') !!}
{!! BlenderForm::media('downloads', 'downloads') !!}

{!! BlenderForm::submit() !!}
