@component('back.layouts.app', [
    'title' => 'Members',
    'breadcrumbs' => html()->backToIndex('Back\MembersController@index'),
])
    <section>
        <div class="grid">
            <h1>New member</h1>

            {{ html()
                ->modelForm($user, 'POST', action('Back\MembersController@store'))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save member') }}

            @include('back.members.partials.form')

            {{ html()->formGroup()->submit('Save member') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>

@endcomponent
