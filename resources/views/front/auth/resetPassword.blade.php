@component('front._layouts.main', [
    'title' => __('auth.titleChangePassword')
])
    <h1>
        {{ html()->avatar($user, '-large') }} <br>
        @lang('auth.titleChangePassword')
    </h1>

    {{ html()->form('POST', 'Front\Auth\ResetPasswordController@reset')->open() }}

    {{ html()->hidden('token', $token) }}
    {{ html()->hidden('email', $user->email) }}

    {{ html()->formGroup()->withContents(
        html()->info(__('auth.resetInstructions'))
       )
    }}

    {{ html()->formGroup()->required()->password('password', __('auth.password')) }}
    {{ html()->formGroup()->required()->password('password_confirmation', __('auth.passwordConfirm')) }}

    {{ html()->formGroup()->submit(__('auth.passwordMail.'.($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser').'.resetButton')) }}

    {{ html()->form()->close() }}
@endcomponent
