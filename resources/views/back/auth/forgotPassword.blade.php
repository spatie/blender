@component('back._layouts.master', [
    'title' => __('Wachtwoord vergeten')
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
                @lang('Wachtwoord vergeten')
            </h1>

            {{ html()->info(__(session('status')) ?: __('Geef je e-mailadres op en we sturen je een link waarmee je je wachtwoord kan wijzigen')) }}

            {{ html()->formGroup()->email('email', 'E-mail') }}

            {{ html()->formGroup()->withContents(
                html()->button()
                    ->type('submit')
                    ->text(__('Link verzenden'))
                    ->class('button -default')
            )->class('-buttons') }}

            <div class="form__group__help">
                <a href="{{ login_url() }}">
                    @lang('Terug naar login')
                </a>
            </div>

            {{ html()->form()->close() }}
        </div>
    </section>
@endcomponent
