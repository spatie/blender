{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::translated([
    'name' => 'text',
    'text' => 'redactor',
]) !!}

{!! BlenderForm::select('parent_id', $parentMenuItems) !!}

{!! BlenderForm::media('images', 'images') !!}
{!! BlenderForm::media('downloads', 'downloads') !!}

{!! BlenderForm::seo() !!}

{!! BlenderForm::submit() !!}
