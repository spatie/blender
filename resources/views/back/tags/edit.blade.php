@component('back.layouts.app', [
    'title' => 'Tags',
    'breadcrumbs' => html()->backToIndex('Back\TagsController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ $model->name ?: 'New tag' }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\TagsController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save tag') }}

            @include('back.tags.partials.form')

            {{ html()->formGroup()->submit('Save tag') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>

@endcomponent
