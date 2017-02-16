@component('back._layouts.master', [
    'pageTitle' => __('Leden'),
    'breadcrumbs' => html()->backToIndex('Back\MembersController@index'),
])
    <section>
        <div class="grid">
            <h1>@lang('Nieuw lid')</h1>

            {{ html()
                ->modelForm($user, 'POST', action('Back\MembersController@store'))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar lid') }}

            @include('back.members._partials.form')

            {{ html()->formGroup()->submit('Bewaar lid') }}

            {{ html()->endModelForm() }}
        </div>
    </section>

@endcomponent
