@component('back._layouts.master', [
    'pageTitle' => __('Leden'),
    'breadcrumbs' => html()->backToIndex('Back\MembersController@index'),
])
    <section>
        <div class="grid">
            <h1>{{ $user->full_name }}</h1>

            {{ html()
                ->modelForm($user, 'PATCH', action('Back\MembersController@update', $user->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar lid') }}

            @include('back.members._partials.form')

            {{ html()->formGroup()->submit('Bewaar lid') }}

            {{ html()->endModelForm() }}
        </div>
    </section>
@endcomponent
