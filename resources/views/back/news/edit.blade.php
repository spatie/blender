@component('back.layouts.app', [
    'title' => 'News',
    'breadcrumbs' => html()->backToIndex('Back\NewsController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ html()->onlineIndicator($model->online) }}
                {{ $model->name ?: 'New article' }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\NewsController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save article') }}

            @include('back.news.partials.form')

            {{ html()->formGroup()->submit('Save article') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
