@component('back._layouts.master', [
    'title' => __('Tags'),
    'breadcrumbs' => html()->backToIndex('Back\TagsController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ $model->name ?: __('Nieuwe tag') }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\TagsController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar tag') }}

            @include('back.tags._partials.form')

            {{ html()->formGroup()->submit('Bewaar tag') }}

            {{ html()->endModelForm() }}
        </div>
    </section>

@endcomponent
