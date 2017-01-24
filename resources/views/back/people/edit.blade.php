@component('back._layouts.master', [
    'pageTitle' => fragment('back.people.title'),
    'breadcrumbs' => Html::backToIndex('Back\PeopleController@index'),
])

    <section>
        <div class="grid">
            <h1>{!! Html::onlineIndicator($model->online) !!}{{ $model->name ?: fragment('back.people.new') }}</h1>

            {!! Form::openDraftable([
                'method' =>'PATCH',
                'action' => ['Back\PeopleController@update', $model->id],
                'class' => '-stacked',
            ], $model) !!}

            @include('back.people._partials.form')

            {!! Form::close() !!}
        </div>
    </section>

@endcomponent
