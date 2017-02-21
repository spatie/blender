@component('front._layouts.main', [
    'title' => __('auth.titleResetPassword')
])
    {{ html()->form('POST', action('Front\Auth\ForgotPasswordController@sendResetLinkEmail'))->open() }}

    {{ html()->info(session('status') ?: __('auth.resetPassword.intro')) }}

    {{ html()->formGroup()->email('email', __('auth.email')) }}

    <p>
        {{ html()->button(__('auth.resetPassword.button'), 'submit')->class('button--primary') }}
    </p>

    <p>
        <a href="{{ login_url() }}">@lang('auth.toLogin')</a>
    </p>

    {{ html()->form()->close() }}
@endcomponent
