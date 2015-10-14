{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::select('type', $model->present()->allTagTypes) !!}

{!! BlenderForm::translated([
    'name' => 'text',
    'description' => 'redactor',
]) !!}

{!! BlenderForm::submit() !!}
