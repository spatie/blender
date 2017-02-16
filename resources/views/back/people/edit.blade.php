@component('back._layouts.master', [
    'title' => __('Team'),
    'breadcrumbs' => html()->backToIndex('Back\PeopleController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ html()->onlineIndicator($model->online) }}
                {{ $model->name ?: __('Nieuw persoon') }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\PeopleController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar persoon') }}

            @include('back.people._partials.form')

            {{ html()->formGroup()->submit('Bewaar persoon') }}

            {{ html()->endModelForm() }}
        </div>
    </section>
@endcomponent
