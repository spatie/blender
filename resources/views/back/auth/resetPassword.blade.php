@component('back._layouts.master', [
    'title' => $user->hasNeverLoggedIn() ? __('Wachtwoord instellen') : __('Wachtwoord wijzigen')
])
    <section class="v-auth">
        <div class="v-auth__card">
            <h1 class="v-auth__title -small">
                {{ html()->avatar($user, '-large v-auth__gravatar') }}<br>
                {{ __('Wachtwoord wijzigen') }}
            </h1>

            {{ html()
                ->modelForm($user, 'POST', action('Back\Auth\ResetPasswordController@reset'))
                ->class('-stacked v-auth__form')
                ->open() }}

            {{ html()->hidden('token', $token) }}
            {{ html()->hidden('email') }}

            {{ html()->info(__('Je nieuwe wachtwoord moet minstens 8 karakters lang zijn.')) }}

            {{ html()->formGroup()->password('password', 'Wachtwoord') }}
            {{ html()->formGroup()->password('password_confirmation', 'Wachtwoord (nogmaals)') }}

            {{ html()->formGroup()->withContents(
                html()->button()
                    ->type('submit')
                    ->text($user->hasNeverLoggedIn() ? __('Wachtwoord instellen') : __('Wachtwoord wijzigen'))
                    ->class('button -default')
            )->class('-buttons') }}

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
