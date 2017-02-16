@component('back._layouts.master', [
    'title' => __('Nieuws'),
    'breadcrumbs' => html()->backToIndex('Back\NewsController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ html()->onlineIndicator($model->online) }}
                {{ $model->name ?: __('Nieuw nieuwsbericht') }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\NewsController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar nieuws') }}

            @include('back.news._partials.form')

            {{ html()->formGroup()->submit('Bewaar nieuws') }}

            {{ html()->endModelForm() }}
        </div>
    </section>
@endcomponent
