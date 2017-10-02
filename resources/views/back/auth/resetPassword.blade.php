@component('back._layouts.master', [
    'title' => $user->hasNeverLoggedIn() ? 'Set password' : 'Change password',
])
    <section class="v-auth">
        <div class="v-auth__card">
            <h1 class="v-auth__title -small">
                {{ html()->avatar($user, '-large v-auth__gravatar') }}<br>
                Change password
            </h1>

            {{ html()
                ->modelForm($user, 'POST', action('Back\Auth\ResetPasswordController@reset'))
                ->class('-stacked v-auth__form')
                ->open() }}

            {{ html()->hidden('token', $token) }}
            {{ html()->hidden('email') }}

            {{ html()->info('Your new password must contain at least 8 characters') }}

            {{ html()->formGroup()->password('password', 'Password') }}
            {{ html()->formGroup()->password('password_confirmation', 'Password (repeat)') }}

            <div class="form__group -buttons">
                <button type="submit" class="button -default">
                    {{ $user->hasNeverLoggedIn() ? 'Set password' : 'Password wijzigen' }}
                </button>
            </div>

            {{ html()->closeModelForm() }}
        </div>
    </section>
@endcomponent
