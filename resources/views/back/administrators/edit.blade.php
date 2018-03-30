@component('back.layouts.app', [
    'title' => 'Administrators',
    'breadcrumbs' => html()->backToIndex('Back\AdministratorsController@index'),
])
    <section>
        <div class="grid">
            <h1>{{ $user->email }}</h1>

            <div class="h-margin-bottom">
                {{ html()->avatar($user) }}
                <span class="help -small">
                    You can specify your profile image on <a href="https://gravatar.com">gravatar.com</a>.
                </span>
            </div>

            {{ html()
                ->modelForm($user, 'PATCH', action('Back\AdministratorsController@update', $user->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save administrator') }}

            @include('back.administrators.partials.form')

            {{ html()->formGroup()->submit('Save administrator') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
