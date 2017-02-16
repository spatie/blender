@component('back._layouts.master', [
    'title' => __('Administrators'),
    'breadcrumbs' => html()->backToIndex('Back\AdministratorsController@index'),
])
    <section>
        <div class="grid">
            <h1>{{ $user->email }}</h1>

            <div>
                {{ html()->avatar($user) }}
                <span class="help -small">
                {!! __('Je kan deze avatar instellen op :link', ['link' => '<a href="https://gravatar.com">gravatar.com</a>']) !!}
            </span>
            </div>

            {{ html()
                ->modelForm($user, 'PATCH', action('Back\AdministratorsController@update', $user->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar administrator') }}

            @include('back.administrators._partials.form')

            {{ html()->formGroup()->submit('Bewaar administrator') }}

            {{ html()->endModelForm() }}
        </div>
    </section>
@endcomponent
