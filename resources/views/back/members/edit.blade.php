@component('back.layouts.app', [
    'title' => 'Members',
    'breadcrumbs' => html()->backToIndex('Back\MembersController@index'),
])
    <section>
        <div class="grid">
            <h1>{{ $user->full_name }}</h1>

            {{ html()
                ->modelForm($user, 'PATCH', action('Back\MembersController@update', $user->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save member') }}

            @include('back.members.partials.form')

            {{ html()->formGroup()->submit('Save member') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
