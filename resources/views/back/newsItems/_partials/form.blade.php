{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::translated([
    'name' => 'text',
    'text' => 'redactor',
]) !!}

{!! BlenderForm::date('publish_date') !!}

{!! BlenderForm::category('news_item_category') !!}
{!! BlenderForm::tags('news_item_tag') !!}

{!! BlenderForm::images('images') !!}
{!! BlenderForm::downloads('downloads') !!}

{!! BlenderForm::submit() !!}
