{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::translated([
    'name' => 'text',
    'text' => 'redactor',
]) !!}

{!! BlenderForm::date('publish_date') !!}

{!! BlenderForm::images('images') !!}

{!! BlenderForm::downloads('downloads') !!}

{!! BlenderForm::submit() !!}
