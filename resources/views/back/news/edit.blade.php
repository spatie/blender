@component('back._layouts.master', [
    'pageTitle' => fragment('back.news.title'),
    'breadcrumbs' => html()->backToIndex('Back\NewsController@index'),
])

    <section>
        <div class="grid">
            <h1>
                {{ html()->onlineIndicator($model->online) }}
                {{ $model->name ?: __('Nieuw nieuws') }}
            </h1>

            {{ html()
                ->model($model)
                ->form('PATCH', action('Back\NewsController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar nieuws') }}

            @include('back.news._partials.form')

            {{ html()->formGroup()->submit('Bewaar nieuws') }}

            {{ html()->endModel()->form()->close() }}
        </div>
    </section>

@endcomponent
