@component('front._layouts.main', [
    'title' => __('auth.titleLogin')
])
    {{ html()->form()->open() }}

    <p>
        {{ html()->label('email', __('auth.email')) }}
        {{ html()->email('email')->attribute('autofocus') }}
        {{ html()->error($errors->first('email')) }}
    </p>
    <p>
        {{ html()->label('password', __('auth.password')) }}
        {{ html()->password('password') }}
        {{ html()->error($errors->first('password')) }}
    </p>
    <p>
        {{ html()
            ->button(__('auth.login'))
            ->type('submit')
            ->class('button--primary')
        }}
    </p>

    {{ html()->form()->close() }}

    <p>
        <a href="{{ action('Front\Auth\ForgotPasswordController@showLinkRequestForm') }}">{{ __('auth.forgotPassword') }}</a>
        |
        <a href="{{ register_url() }}">{{ __('auth.noAccount') }}</a>
    </p>
@endcomponent
