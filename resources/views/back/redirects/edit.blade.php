@component('back.layouts.app', [
    'title' => 'Redirects',
    'breadcrumbs' => html()->backToIndex('Back\RedirectsController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ $model->old_url ?: 'New redirect' }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\RedirectsController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save redirect') }}

            @include('back.redirects.partials.form')

            {{ html()->formGroup()->submit('Save redirect') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
