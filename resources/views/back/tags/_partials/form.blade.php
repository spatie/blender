{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::select('type', $model->present()->allTagTypes) !!}

{!! BlenderForm::translated([
    'name' => 'text',
]) !!}

{!! BlenderForm::submit() !!}
