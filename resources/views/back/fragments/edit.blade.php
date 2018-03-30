@component('back.layouts.app', [
    'title' => 'Edit fragment',
    'breadcrumbs' => html()->backToIndex('Back\FragmentsController@index'),
])
    <section>
        <div class="grid">
            <h1 class=":text-ellipsis">
                {{ $fragment->name }}
            </h1>

            @if($fragment->description)
                <div class="alerts">
                    <div class="alert--info -small -inline">
                        {{ $fragment->description }}
                    </div>
                </div>
            @endif

            {{ html()
                ->modelForm($fragment, 'PATCH', action('Back\FragmentsController@update', $fragment->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Save fragment') }}

            @include('back.fragments.partials.form')

            {{ html()->formGroup()->submit('Save fragment') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
