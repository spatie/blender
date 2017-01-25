@component('back._layouts.master', [
    'pageTitle' => fragment('back.auth.titleLogin')
])

    <section class="v-auth">

        @include('back._layouts._partials.flashMessage', ['extraClass' => 'alerts--fixed'])

        {{-- @include('auth._partials.lang') --}}
        <div class="v-auth__card">
            {!! Form::open(['class'=>'-stacked v-auth__form']) !!}
            <h1 class="v-auth__title">
                <img class="v-auth__logo" src="/images/svg/blender.svg">
                Blender
            </h1>

            <div class="form__group">
                {!! Form::label('email', __('Email')) !!}
                {!! Form::email('email', Input::old('email'), ['autofocus' => true ]) !!}
                {!! Html::error($errors->first('email')) !!}
            </div>

            <div class="form__group">
                {!! Form::label('password', fragment('back.auth.password')) !!}
                {!! Form::password('password', [ ]) !!}
                {!! Html::error($errors->first('password')) !!}
                <div class="form__group__help">
                    <a href="{{ action('Back\Auth\ForgotPasswordController@showLinkRequestForm') }}">{{ fragment('back.auth.forgotPassword') }}</a>
                </div>
            </div>

            <div class="form__group -buttons">
                {!! Form::button(fragment('back.auth.login'), ['type'=>'submit', 'class'=>'button -default']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </section>

    {{--
    <div class="v-auth__credit">
        picture: Folkert Gorter
    </div>
    --}}
@endcomponent