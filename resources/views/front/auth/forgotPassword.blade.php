@component('front._layouts.main', [
    'title' => __('auth.resetPassword')
])

    {{ html()->form('POST', action('Front\Auth\ForgotPasswordController@sendResetLinkEmail'))->open() }}

    <div class="form__group">
        <div class="alert--info">
            {{ session('status') ?: __('auth.resetPasswordInstructions') }}
        </div>
    </div>

    {{ html()->formGroup()->required()->email('email', __('auth.email')) }}

    {{ html()->formGroup()->submit(__('auth.mailMe')) }}

    {{ html()->form()->close() }}

    <p>
        <a href="{{ login_url() }}">
            {{ __('auth.toLogin') }}
        </a>
    </p>
@endcomponent
