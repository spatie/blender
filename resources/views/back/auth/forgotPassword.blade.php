@component('back._layouts.master', [
    'title' => $user->hasNeverLoggedIn() ? __('Wachtwoord instellen') : __('Wachtwoord wijzigen')
])
    <section class="v-auth">
        @if(html()->flashMessage())
            {{ html()->flashMessage()->class('alerts--fixed') }}
        @endif

        <div class="v-auth__card">
            {{ html()
                ->modelForm($user, 'POST', 'Back\Auth\ForgotPasswordController@sendResetLinkEmail')
                ->class('-stacked v-auth__form')
                ->open() }}

            <h1 class="v-auth__title -small">
                {{ $user->hasNeverLoggedIn() ? __('Wachtwoord instellen') : __('Wachtwoord wijzigen') }}
            </h1>

            {{ html()->info(session('status') ?: __('Geef je e-mailadres op en we sturen je een link waarmee je je wachtwoord kan wijzigen')) }}

            {{ html()->formGroup()->email('email') }}

            {{ html()->formGroup()->withContents(
                html()->button()
                    ->type('submit')
                    ->text($user->hasNeverLoggedIn() ? __('Wachtwoord instellen') : __('Wachtwoord wijzigen'))
                    ->class('button -default')
            )->class('-buttons') }}

            <div class="form__group__help">
                <a href="{{ login_url() }}">
                    @lang('Terug naar login')
                </a>
            </div>

            {{ html()->endModelForm() }}
        </div>
    </section>
@endcomponent
