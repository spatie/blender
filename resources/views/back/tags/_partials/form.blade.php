{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::select('type', $model->allTagTypes) !!}

{!! BlenderForm::translated([
    'name' => 'text',
]) !!}

{!! BlenderForm::submit() !!}
