@component('back._layouts.master', [
    'pageTitle' => fragment('back.auth.titleLogin')
])
    <section class="v-auth">

        @include('back._layouts._partials.flashMessage', ['extraClass' => 'alerts--fixed'])

        <div class="v-auth__card">
            {{ html()->form()->class('-stacked v-auth__form')->open() }}

            <h1 class="v-auth__title">
                <img class="v-auth__logo" src="/images/svg/blender.svg">
                Blender
            </h1>

            <div class="form__group">
                {{ html()->label('Email', 'email') }}
                {{ html()->email('email')->attribute('autofocus')->required() }}
                {{ html()->error($errors->first('email')) }}
            </div>

            <div class="form__group">
                {{ html()->label('Wachtwoord', 'password') }}
                {{ html()->password('password')->required() }}
                {{ html()->error($errors->first('password')) }}

                <div class="form__group__help">
                    <a href="{{ action('Back\Auth\ForgotPasswordController@showLinkRequestForm') }}">{{ fragment('back.auth.forgotPassword') }}</a>
                </div>
            </div>

            <div class="form__group -buttons">
                {{ html()
                    ->button('Log in')
                    ->type('submit')
                    ->class('button -default') }}
            </div>

            {{ html()->form()->close() }}
        </div>
    </section>

    {{--<div class="v-auth__credit">picture: Folkert Gorter</div>--}}
@endcomponent
