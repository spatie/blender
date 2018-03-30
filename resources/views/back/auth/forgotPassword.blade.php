@component('back.layouts.app', [
    'title' => 'Forgot password',
])
    <section class="v-auth">
        @if(html()->flashMessage())
            <div class="alerts--fixed">
                {{ html()->flashMessage() }}
            </div>
        @endif

        <div class="v-auth__card">
            {{ html()
                ->form('POST', action('Back\Auth\ForgotPasswordController@sendResetLinkEmail'))
                ->class('-stacked v-auth__form')
                ->open() }}

            <h1 class="v-auth__title -small">
                Forgot password
            </h1>

            <div class="alert--info">
                {{ session('status') ?: 'We\'ll send you a link to reset your password.' }}
            </div>

            {{ html()->formGroup()->email('email', 'E-mail') }}

            <div class="form__group -buttons">
                <button class="button -default" type="submit">
                    Send link
                </button>
            </div>

            <div class="form__group__help">
                <a href="{{ route('back.login') }}">
                    Back to login
                </a>
            </div>

            {{ html()->form()->close() }}
        </div>
    </section>
@endcomponent
