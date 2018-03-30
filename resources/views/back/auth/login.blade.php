@component('back.layouts.app', [
    'title' => __('Log in')
])
    <section class="v-auth">
        @if(html()->flashMessage())
            <div class="alerts--fixed">
                {{ html()->flashMessage() }}
            </div>
        @endif

        <div class="v-auth__card">
            {{ html()->form()->class('-stacked v-auth__form')->open() }}

            <h1 class="v-auth__title">
                <img class="v-auth__logo" src="/images/svg/blender.svg">
                Blender
            </h1>

            <div class="form__group">
                {{ html()->label('E-mail', 'email') }}
                {{ html()->email('email')->attribute('autofocus')->required() }}
                {{ html()->error($errors->first('email')) }}
            </div>

            <div class="form__group">
                {{ html()->label('Password', 'password') }}
                {{ html()->password('password')->required() }}
                {{ html()->error($errors->first('password')) }}

                <div class="form__group__help">
                    <a href="{{ action('Back\Auth\ForgotPasswordController@showLinkRequestForm') }}">
                        Forgot password?
                    </a>
                </div>
            </div>

            <div class="form__group -buttons">
                <button class="button -default" type="submit">
                    Log in
                </button>
            </div>

            {{ html()->form()->close() }}
        </div>
    </section>
@endcomponent
