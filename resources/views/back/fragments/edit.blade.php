@component('back._layouts.master', [
    'pageTitle' => __('Wijzig vaste tekst'),
    'breadcrumbs' => html()->backToIndex('Back\FragmentsController@index'),
])

    <section>
        <div class="grid">
            <h1 class=":text-ellipsis">
                {{ $fragment->name }}
            </h1>

            @if($fragment->description)
                <div class="alerts">
                    {{ html()->info($fragment->description, '-small -inline') }}
                </div>
            @endif

            {{ html()
                ->modelForm($fragment, 'PATCH', action('Back\FragmentsController@update', $fragment->id))
                ->class('-stacked')
                ->open() }}

            {{ html()->formGroup()->submit('Bewaar fragment') }}

            @include('back.fragments._partials.form')

            {{ html()->formGroup()->submit('Bewaar fragment') }}

            {{ html()->endModelForm() }}
        </div>
    </section>

@endcomponent
