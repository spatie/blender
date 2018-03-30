@component('back.layouts.app', [
    'title' => 'Team',
    'breadcrumbs' => html()->backToIndex('Back\PeopleController@index'),
])
    <section>
        <div class="grid">
            <h1>
                {{ html()->onlineIndicator($model->online) }}
                {{ $model->name ?: 'New team member' }}
            </h1>

            {{ html()
                ->modelForm($model, 'PATCH', action('Back\PeopleController@update', $model->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save team member') }}

            @include('back.people.partials.form')

            {{ html()->formGroup()->submit('Save team member') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
