@component('front._layouts.main', [
    'title' => __('auth.resetPassword')
])
    <h1>
        {{ html()->avatar($user, '-large') }} <br>
        {{ __('auth.resetPassword') }}
    </h1>

    {{ html()->form('POST', action('Front\Auth\ResetPasswordController@reset'))->open() }}

    {{ html()->hidden('token', $token) }}
    {{ html()->hidden('email', $user->email) }}

    <div class="form__group">
        <div class="alert--info">
            {{ __('auth.resetPasswordInstructions') }}
        </div>
    </div>

    {{ html()->formGroup()->required()->password('password', __('auth.password')) }}
    {{ html()->formGroup()->required()->password('password_confirmation', __('auth.confirmPassword')) }}

    {{ html()->formGroup()->submit($user->hasNeverLoggedIn() ? __('auth.setPassword') : __('auth.resetPassword')) }}

    {{ html()->form()->close() }}
@endcomponent
