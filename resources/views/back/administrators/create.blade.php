@component('back._layouts.master', [
    'pageTitle' => 'Nieuwe gebruiker',
    'breadcrumbs' => Html::backToIndex('Back\AdministratorsController@index'),
])

    <section>
        <div class="grid">
            <h1>{{ fragment("back.administrators.new") }}</h1>

            {!! Form::open([
                'url' => action('Back\AdministratorsController@store'),
                'class' =>'-stacked'
            ]) !!}
            @include("back.administrators._partials.form")
            {!! Form::close() !!}
        </div>
    </section>

@endcomponent