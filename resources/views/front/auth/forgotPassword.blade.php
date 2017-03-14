@component('front._layouts.main', [
    'title' => __('auth.titleResetPassword')
])

    {{ html()->form('POST', action('Front\Auth\ForgotPasswordController@sendResetLinkEmail'))->open() }}

    {{ html()->formGroup()->withContents(
        html()->info(session('status') ?: __('auth.resetPassword.intro'))
       )
    }}

    {{ html()->formGroup()->required()->email('email', __('auth.email')) }}

    {{ html()->formGroup()->submit(__('auth.resetPassword.button')) }}

    {{ html()->form()->close() }}

    <p>
        <a href="{{ login_url() }}">@lang('auth.toLogin')</a>
    </p>
@endcomponent
