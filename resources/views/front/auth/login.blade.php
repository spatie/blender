@component('front.layouts.main', [
    'title' => __('auth.login')
])
    {{ html()->form()->open() }}

    <div class="form-group">
        {{ html()->label(__('auth.email'), 'email')->class('label is-required') }}
        {{ html()->email('email')->required()->attribute('autofocus') }}
        {{ html()->error($errors->first('email')) }}
    </div>

    {{ html()->formGroup()->required()->password('password', __('auth.password')) }}

    {{ html()->formGroup()->submit(__('auth.login')) }}

    {{ html()->form()->close() }}

    <p>
        <a href="{{ action('Front\Auth\ForgotPasswordController@showLinkRequestForm') }}">{{ __('auth.forgotPassword') }}</a>
        |
        <a href="{{ route('register') }}">{{ __('auth.noAccount') }}</a>
    </p>
@endcomponent
