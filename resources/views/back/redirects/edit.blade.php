@component('back._layouts.master', [
    'title' => __('Redirects'),
    'breadcrumbs' => html()->backToIndex('Back\RedirectsController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ $model->old_url ?: __('Nieuwe redirect') }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\RedirectsController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar redirect') }}

            @include('back.redirects._partials.form')

            {{ html()->formGroup()->submit('Bewaar redirect') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
