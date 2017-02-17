@component('front._layouts.main', [
    'title' => __('auth.titleChangePassword')
])
    @slot('mainTitle')
        <h1 class="v-auth__title -small">
            {{ html()->avatar($user, '-large v-auth__gravatar') }} <br>
            @lang('auth.titleChangePassword')
        </h1>
    @endslot

    {{ html()->form('POST', 'Front\Auth\ResetPasswordController@reset')->open() }}

    {{ html()->hidden('token', $token) }}
    {{ html()->hidden('email', $user->email) }}

    {{ html()->info(__('auth.resetInstructions')) }}

    {{ html()->formGroup()->required()->password('password', __('auth.password')) }}
    {{ html()->formGroup()->required()->password('password_confirmation', __('auth.passwordConfirm')) }}

    {{ html()->button()
        ->type('submit')
        ->text(__('auth.passwordMail.'.($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser').'.resetButton'))
        ->class('button--primary') }}

    {{ html()->form()->open() }}
@endcomponent
