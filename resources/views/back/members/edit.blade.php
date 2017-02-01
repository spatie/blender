@component('back._layouts.master', [
    'pageTitle' => $user->email,
    'breadcrumbs' => Html::backToIndex('Back\MembersController@index'),
])

    <section>
        <div class="grid">
            <h1>{{ fragment('back.members.member') }} {{ $user->email }}</h1>
            {!! Form::model(
                $user,
                ['method' => 'PATCH', 'action' => ['Back\MembersController@update', $user->id] ,
                'class' => '-stacked'
            ]) !!}
            @include("back.members._partials.form")
            {!! Form::close() !!}
        </div>
    </section>

@endcomponent
