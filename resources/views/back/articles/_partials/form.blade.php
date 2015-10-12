{!! BlenderForm::checkbox('online') !!}

{!! BlenderForm::translated([
    'name' => 'text',
    'text' => 'redactor',
]) !!}

{!! BlenderForm::date('publish_date') !!}

<div data-media-collection="images"
     data-media-type="images-with-lock"
     data-initial="{{ $model->getMedia('images')->toJson() }}"
     data-locales="{{ collect(config('app.locales'))->toJson() }}"
     data-model="{{ collect(['name' => App\Models\Article::class, 'id' => $model->id])->toJson() }}">
</div>

<div data-media-collection="downloads"
     data-media-type="downloads"
     data-initial="{{ $model->getMedia('downloads')->toJson() }}"
     data-locales="{{ collect(config('app.locales'))->toJson() }}"
     data-model="{{ collect(['name' => App\Models\Article::class, 'id' => $model->id])->toJson() }}">
</div>

{!! BlenderForm::submit() !!}
