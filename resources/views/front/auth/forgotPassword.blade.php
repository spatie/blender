@component('front.layouts.main', [
    'title' => __('auth.forgotPassword')
])

    {{ html()->form('POST', action('Front\Auth\ForgotPasswordController@sendResetLinkEmail'))->open() }}

    <div class="form-group">
        <div class="alert is-info">
            {{ session('status') ?: __('auth.forgotPasswordInstructions') }}
        </div>
    </div>

    {{ html()->formGroup()->required()->email('email', __('auth.email')) }}

    {{ html()->formGroup()->submit(__('auth.mailMe')) }}

    {{ html()->form()->close() }}

    <p>
        <a href="{{ route('login') }}">
            {{ __('auth.toLogin') }}
        </a>
    </p>
@endcomponent
