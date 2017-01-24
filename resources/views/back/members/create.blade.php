@component('back._layouts.master', [
    'pageTitle' => fragment('back.members.new'),
    'breadcrumbs' => Html::backToIndex('Back\MembersController@index'),
])

    <section>
        <div class="grid">
            <h1>{{ fragment("back.members.new") }}</h1>

            {!! Form::open([
                'url' => action('Back\MembersController@store'),
                'class' =>'-stacked'
            ]) !!}
            @include("back.members._partials.form")
            {!! Form::close() !!}
        </div>
    </section>

@endcomponent
