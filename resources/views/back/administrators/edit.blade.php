@component('back._layouts.master', [
    'pageTitle' => $user->email,
    'breadcrumbs' => Html::backToIndex('Back\AdministratorsController@index'),
])

<section>
    <div class="grid">
        <h1>{{ __('Administrator') }} {{ $user->email }}</h1>
        <div>
            {!! Html::avatar($user) !!}
            <span class="help -small">
                    {{ fragment('back.administrators.gravatarInfo') }} <a href="https://gravatar.com">gravatar.com</a>
                </span>
        </div>
        {!! Form::model(
            $user,
            ['method' => 'PATCH', 'action' => ['Back\AdministratorsController@update', $user->id] ,
            'class' => '-stacked'
        ]) !!}
        @include("back.administrators._partials.form")
        {!! Form::close() !!}
    </div>
</section>

@endcomponent